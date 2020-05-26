<? ini_set('display_errors',1);
include_once('../func/php.php');

$thumb_folder = 'thumbs';
$item_folder = 'items';

const IMAGE_HANDLERS = [
	IMAGETYPE_JPEG => [
		'load' => 'imagecreatefromjpeg',
		'save' => 'imagejpeg',
		'quality' => 100
	],
	IMAGETYPE_PNG => [
		'load' => 'imagecreatefrompng',
		'save' => 'imagepng',
		'quality' => 0
	],
	IMAGETYPE_GIF => [
		'load' => 'imagecreatefromgif',
		'save' => 'imagegif'
	]
];

function createThumbnail($src, $dest, $targetWidth = 100, $targetHeight = null) {
	//echo "src:".$src." dest:".$dest;

	/**
	 * @param $src - a valid file location
	 * @param $dest - a valid file target
	 * @param $targetWidth - desired output width
	 * @param $targetHeight - desired output height or null
	 */
	// $src, $dest using relative path link like /folder/file.extension

	if ( file_exists($src) && !file_exists($dest) ){
		// 1. Load the image from the given $src
		// - see if the file actually exists
		// - check if it's of a valid image type
		// - load the image resource

		// get the type of the image
		// we need the type to determine the correct loader
		$type = exif_imagetype($src);

		// if no valid type or no handler found -> exit
		if (!$type || !IMAGE_HANDLERS[$type]) {
			return null;
		}

		// load the image with the correct loader
		$image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);

		// no image found at supplied location -> exit
		if (!$image) {
			return null;
		}


		// 2. Create a thumbnail and resize the loaded $image
		// - get the image dimensions
		// - define the output size appropriately
		// - create a thumbnail based on that size
		// - set alpha transparency for GIFs and PNGs
		// - draw the final thumbnail

		// get original image width and height
		$width = imagesx($image);
		$height = imagesy($image);

		// maintain aspect ratio when no height set
		if ($targetHeight == null) {

			// get width to height ratio
			$ratio = $width / $height;

			// if is portrait
			// use ratio to scale height to fit in square
			if ($width > $height) {
				$targetHeight = floor($targetWidth / $ratio);
			}
			// if is landscape
			// use ratio to scale width to fit in square
			else {
				$targetHeight = $targetWidth;
				$targetWidth = floor($targetWidth * $ratio);
			}
		}

		// create duplicate image based on calculated target size
		$thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

		// set transparency options for GIFs and PNGs
		if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {

			// make image transparent
			imagecolortransparent(
				$thumbnail,
				imagecolorallocate($thumbnail, 0, 0, 0)
			);

			// additional settings for PNGs
			if ($type == IMAGETYPE_PNG) {
				imagealphablending($thumbnail, false);
				imagesavealpha($thumbnail, true);
			}
		}

		// copy entire source image to duplicate image and resize
		imagecopyresampled(
			$thumbnail,
			$image,
			0, 0, 0, 0,
			$targetWidth, $targetHeight,
			$width, $height
		);


		// 3. Save the $thumbnail to disk
		// - call the correct save method
		// - set the correct quality level

		// save the duplicate version of the image to disk
		return call_user_func(
			IMAGE_HANDLERS[$type]['save'],
			$thumbnail,
			$dest,
			IMAGE_HANDLERS[$type]['quality']
		);
	}
}

$url_folder = $_POST['folder'] or $_REQUEST['folder'];
if( isset($url_folder) && !empty($url_folder) && $url_folder != $item_folder ){
    $item_folder = $item_folder."/".$url_folder;
}

class Gallery{
    private $dirPath;
    private $files = array();
    private $folders = array();
    
    public function __construct($dir){
        $this->dirPath = $dir;
    }
    
    public function __destruct(){
        $this->files = null;
        $this->folders = null;
    }

    public function load(){
        $directory = dir($this->dirPath);

        while ($file = $directory->read()){

            if(preg_match('#\.(jpe?g|png|mp4|gif)$#i', $file)) {
                $this->files[] = $file;
                
                if( strtolower(pathinfo($file, PATHINFO_EXTENSION)) != 'mp4'){
					createThumbnail($this->dirPath .'/'.$file, 'thumbs/'.$file.'.jpg');
                }
            }else{
                $path = realpath($this->dirPath);

                // check if var is real path, if dir exists, and it is not starting with . or .. or ......
                if( $path !== false AND is_dir($path) && !strstr($file, '.') ){
                    $this->folders[] = $file;
                }
            }
        }
        $directory->close();
    }

    public function GetFileList(){
		sort($this->files);
        return $this->files;
    }
    public function GetFolderList(){
		sort($this->folders);
        return $this->folders;
    }
}

$gallery = new Gallery($_SERVER['DOCUMENT_ROOT'].'/'.$item_folder);
$gallery->load();

$folders = $gallery->GetFolderList();
$files = $gallery->GetFileList();

$result = array_merge($folders, array(""), $files);
echo json_encode($result);