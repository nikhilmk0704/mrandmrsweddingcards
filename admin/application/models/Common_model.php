<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

//get the mail template
 function mailTemplate($type)
 {  $temp_arr="";
    $templateQuery="SELECT `type`, `email_template`,`subject` FROM `email_templates` WHERE 1 AND `type`='".$type."' ";
    $tempResult = $this->db->query($templateQuery);
    $rowTemp = $tempResult->row();
    if ($tempResult->num_rows() == 1) {
        $type = $rowTemp->type;
        $template = $rowTemp->email_template;
        $subject = $rowTemp->subject;
        $temp_arr=array('type'=>$type,'template'=>$template,'subject'=>$subject);
    }
    return $temp_arr;
 }
    
 //send email 

     public function  sendEmail($email,$subject,$message)
	{
        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sctappca@gmail.com',
            'smtp_pass' => 'sctappca123456',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );


        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('noreply@appsct.com');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
	}

    public function get_image_aws($file_name,$s3_name){
        //file_name is folder name + filename
        @require_once 'sdk/sdk.class.php';
        $s3 = new AmazonS3();
        $bucket = $s3_name;
        #$bucket = S3_NAME;
        $secureURl = $s3->get_object_url($bucket,$file_name,'15 minutes');
        return $secureURl;

    }
    public function delete_s3_file($filename,$s3_name){
        @require_once 'sdk/sdk.class.php';
        $s3 = new AmazonS3();
        @$s3->disable_ssl_verification();
        $bucket = $s3_name;
        $response=$s3->delete_object($bucket, $filename);
        return $response;
        
    }
    public function s3Upload($tar_file,$s3_name){
        @require_once 'sdk/sdk.class.php';
        $s3 = new AmazonS3();
        @$s3->disable_ssl_verification();       
        $seg = explode("/",$tar_file);
        $bucket = $s3_name;
        $file_location = basename($tar_file);
        $filename = $seg[1]."/".$file_location;
        $contentType=$this->mime_content_typealways($file_location);
        $fileResource = fopen($tar_file, 'r');
        $response = $s3->create_object($bucket,$filename,array('fileUpload' => $fileResource,'contentType' => $contentType));
        return $response;   
    }

        function mime_content_typealways($filename) {

            $mime_types = array(

                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',

                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',

                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',

                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',

                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',

                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
                'ppt' => 'application/vnd.ms-powerpoint',

                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            );
            $fileExtensionArray = explode('.',$filename);
            $ext = strtolower($fileExtensionArray[count($fileExtensionArray)-1]);
            if (array_key_exists($ext, $mime_types)) {
                return $mime_types[$ext];
            }
            elseif (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME);
                $mimetype = finfo_file($finfo, $filename);
                finfo_close($finfo);
                return $mimetype;
            }
            else {
                return 'application/octet-stream';
            }
        }
  
}