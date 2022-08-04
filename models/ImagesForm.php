<?php

namespace app\models;
 
use Yii;
use yii\base\Model;
use app\models\Images;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\helpers\Inflector;
 
class ImagesForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $filename;
 
    public function rules()
    {
        return [
            [['filename'], 
            'image', 
            'skipOnEmpty' => false, 
            'extensions' => 'png, jpg', 
            'maxFiles' => 5,
            'checkExtensionByMimeType'=>false],
        ];
    }
     
    public function upload()
    {
        //$dir = Yii::getAlias('@app/web/uploads/');
        $dir = Yii::getAlias(Yii::$app->params['uploadPath']);
        if ($this->validate()) { 
            foreach ($this->filename as $file) {
                $filename = $this->getUniqFilename($file->baseName, $file->extension);
                $file->saveAs( $dir . $filename);
                $this->saveImageDB($filename);
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function getUniqFilename($filename, $extension)
    {
        $filename = Inflector::transliterate($filename);
        $filename = Inflector::slug($filename, '-');
        $isFileExist = Images::find()->where(['filename' => $filename . '.' . $extension])->exists();
        if($isFileExist){
            $filename .= '_' . substr(md5(microtime() . rand(0, 1000)), 0, 10);
        }
        return($filename . '.' . $extension);
    } 
    
    private function saveImageDB($filename)
    {
        $model = new Images;
        $model->filename = $filename;
        $model->upload = new Expression('NOW()');;
        return $model->save();
    }
}