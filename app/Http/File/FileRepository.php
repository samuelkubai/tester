<?php namespace App\Http\File;

use App\File;
use App\Http\Mail\GroupMailer;
use App\Http\Traits\Postable;
use ZipArchive;

class FileRepository
{

    use Postable;


    public $allowedTypes = [
        'txt', 'pdf', 'docx', 'jpg', 'png', 'jpeg', 'jpe', 'ppt','pptx','pptm','pot','potx', 'doc',  'zip', 'tar', 'rar', '7z', 'iso','xls', 'xlsm', 'xlsx', 'xlsb', 'xlt',
    ];

    protected $profileTypes = [
        'png', 'jpg', 'jpeg', 'jpe'
    ];
    /**
     * @var
     */
    private $groupMailer;

    /**
     * @param GroupMailer $groupMailer
     */
    function __construct(GroupMailer $groupMailer)
    {

        $this->groupMailer = $groupMailer;
    }

    public function uploadGroupDocument($file, $location, $folder, $requestName = null)
    {
        $group = $folder->group()->first();


        if($requestName == null)
            $name = $file->getClientOriginalName();

        else
        {
            $fileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $requestName);
            $fileName = filter_var($fileName, FILTER_SANITIZE_URL);
            $name = $fileName.'.'.$file->getClientOriginalExtension();
        }

        $rand = $this->randomFileName();
        $actualName =  $rand .$name;

        $destination = 'uploads/' . $location ;

        $success = $file->move($destination, $actualName);

        $source = '/uploads/'.$location . '/' . $actualName;

        $file_record = $folder->files()->create([
            'name' => $name,
            'type' => $file->getClientOriginalExtension(),
            'rand' => $rand,
            'source' => $source,
            'user_id' => \Auth::user()->id,
        ]);

        $message = 'New document: ' . $name . ' uploaded to Folder: ' . $folder->name .' by '.\Auth::user()->firstName.' '.\Auth::user()->lastName;
        $url = '/manager/'.$group->username.'/'.$folder->id;
        $this->post($message, $group, $url);
        $this->groupMailer->sendFileUploadNotification($group,$file_record, $url);
        return true;

    }

    /**
     * @param $file
     * @param $location
     * @param $folder
     * @param $type
     * @param $requestName
     * @return bool
     */
    public function uploadPersonalDocument($file, $location, $folder, $type, $requestName)
    {

        if($requestName == null)
            $name = $file['file']['name'];
        else
        {
            $fileName = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $requestName);
            $fileName = filter_var($fileName, FILTER_SANITIZE_URL);
            $name = $fileName.'.'.$type;
        }
        $rand = $this->randomFileName();
        $actualName = $name.$rand . '.' . $type;

        $tmpName = $file['file']['tmp_name'];
        $destination = 'uploads/' . $location . '/' . $actualName;

        if (!move_uploaded_file($tmpName, $destination)) {
            return false;
        }

        $file = File::create([
            'name' => $name,
            'type' => $type,
            'rand' => $rand,
            'source' => $destination,
            'folder_id' => '0',
            'user_id' => \Auth::user()->id,
        ]);

        $folder->files()->attach($file->id);

        return true;

    }

    public function uploadProfilePicture($data, $request, $user)
    {
        if(($request->file('profile')->getClientSize() > 10000000))
            return false;
        if(!$this->authenticateType($request->file('profile')->getClientOriginalExtension(), $this->profileTypes))
            return false;
        $name = $data['name'];
        $tmpName = $data['tmp_name'];
        $location = 'uploads/images/profile/';
        $type = $request->file('profile')->getClientOriginalExtension();
        $rand = $this->randomFileName();
        $destination = $location . $rand . '.' . $type;

        if (!move_uploaded_file($tmpName, $destination)) {
            return false;
        }
        $user->profile()->delete();
        $user->profile()->create([
            'name' => $name,
            'type' => $type,
            'source' => $destination,
            'rand' => $rand,
        ]);

        return true;
    }

    public function authenticateType($itemType, $allowedTypes)
    {
        foreach($allowedTypes as $type)
        {
            if((strtolower($itemType) == $type))
                return true;
        }
        return false;
    }




    public function randomFileName()
    {
        $randomName = rand(1000000, 9999999);

        if(File::where('rand', $randomName)->first() != null)
        {
            return $this->randomFileName();

        } else {
            return $randomName;
        }
    }
}

/*
    public function downloadFile($file)
    {
        ignore_user_abort(false);
        set_time_limit(0); // disable the time limit for this script
        $fileName = $file->rand . '.' .$file->type;
        $path = "C:\wamp\www\skoolspace\public\uploads\documents\\"; // change the path to fit your websites document structure
        $dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $fileName); // simple file name validation
        $dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
        $fullPath = $path.$dl_file;

        if ($fd = fopen ($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                    header("Content-type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
                    break;
                case "txt":
                    header("Content-type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
                    break;
                // add more headers for other content types here
                default;
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
                    break;
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        fclose ($fd);
    }
*/