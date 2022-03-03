<?php

//This file is based on Edinburgh University's John Lee's 'ImageController' example 1/2/22
// Written by Wayne Gault 27/2/22

// ImageController Class provides methods for working with the images.

class ImageController extends PageController
{
    private $filedata;
    private $uploadResult = null;
    private $acceptedTypes        = ['image/jpeg', 'image/png', 'image/gif'];
    // tiff and svg removed: image processing code can't handle them

    // Upload -   see https://fatfreeframework.com/3.7/web#receive
    //==============================================================================
    public function upload()
    {
        global $f3; // ensures we can call functions like $f3->set() from inside here.
        $f3->set('CurrentImageController', $this); // needed to get the first parameter for receive().
        Web::instance()->receive(
        // Web::receive() is a function in F3 'web' class that receives and process files from a client sent via PUT or POST.
        // On POST it uploads to php tmp/ folder. If the parameter is true, it moves the file to the directory specified
        // in UPLOADS system var (defined in index.php globals). It returns an array called 'filedata'.
            'ImageController::callback',
           true, // second parameter for receive(). Set to true if overwrite ok.
                        // If an uploaded file has the same name as a current file, should it overwrite?
                        //yes because all filenames are changed to usernames to avoid inadvertent
                        // overwriting by a different user but allow the user to change their pic.
            'ImageController::slug'
        );// end of web::receive()

        //This doesn't work yet
//        var_dump($this->filedata);
//        //resize image
//        $filepath= $this->filedata['name']; // '/home/gaultedi/AboveWebRoot/ServerImages/filename.xxx'
//        $img = new Image($filepath, false, $path= null); //2nd parameter, flag, switches file history. 3rd, path is
//        // null for an absolute path (as above)
//        $img->resize(250,250, true, true); //width, height, crop, enlarge - reduce image to thumbnail size
//        var_dump($img);

        if ($this->uploadResult != 'success') { // if null, probably not really an image file so no need a placeholder image
            if (!is_null($this->uploadResult)) {
                $this->uploadResult = self::setUploadFailMessage('The file could not be uploaded. The reason is unknown!');
            }
            $f3->set('POST.pic_file', 'Person.png'); //the placeholder image will be returned to the db
            return null;
        }
        echo 'end of image upload';
        return $this->filedata;
    } // end of upload() function


    // Callback function provides first parameter for web::receive()
    public static function callback($filedata,$formFieldName) {
        // $file and $formFieldName returned by web::receive(), but we dont need the second parameter.
        // This function runs if there's a successful upload to php tmp/ folder by receive().
        global $f3;

        $ImageController= $f3->get('CurrentImageController'); // current ImageController object
        $ImageController->filedata = $filedata;        // export object filedata to outside this function

        // if file too big, this will stop moving it from php tmp/ to UPLOADS
        if ( $ImageController->filedata['size'] > (2 * 1024 * 1024)) { // if bigger than 2 MB
            $ImageController->uploadResult = ImageController::setUploadFailMessage('File > 2MB');
            return false;
        }
        // If not a valid file type (ie in 'acceptedTypes'), this will stop moving it from php tmp/ to UPLOADS
        if (!in_array( $ImageController->filedata['type'],  $ImageController->acceptedTypes)) {        // if not an approved type
            $ImageController->uploadResult = ImageController::setUploadFailMessage('File type not accepted');
            return false;
        }

        // add to this function to
        // - screen for virus (eg run past an online service)
        // - validate that the extension jpg, gif or png is real and not faked (tinram/file-identifier - magic bytes) -
        // - screen for 'adult' pictures (on line ai checker?)


        // Conclude that there is no problem shifting file from php tmp/ to UPLOADS
        $ImageController->uploadResult = 'success';
        return true; // allows the file to be moved from php tmp/ dir to UPLOADS folder
    } // end of callback (first parameter for receive()).

    // Slug function provides third parameter for web::receive()- this is used here to change filename
    public static function slug($fileBaseName, $formFieldName) {
        // If this slug parameter is set to true it will rename file name to UTF-8 filename. But if a function
        // is included it can change name of uploaded file to email_address.origional_extension.
        // Clearly identify who the image is attributed to for data protection purposes and fair processing.
        // Also to prevent another user inadvertently overwriting the image with an identical image name

        global $f3; // ensures we can call functions like $f3->set() from inside here
        $ext = pathinfo($fileBaseName)['extension'];
        $newName = $f3->GET('POST.email') . '.' . $ext;
                $f3->set('POST.pic_file', $newName); // ensure new name of file saved to users/pic_file field.
        $fileBaseName = $newName;
        return $newName;
    }// end of slug function (third parameter for receive().)

    public static function setUploadFailMessage($reason) {
        return "<div class='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main'>how do we get this below the header? <h1>Image upload failed!</h1>$reason<br><a href=home/>Return (change this to update user in due course)</a>";
         }


}// end of ImageController
