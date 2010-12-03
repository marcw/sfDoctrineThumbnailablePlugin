<?php

/**
 * sfImageResizeSmallestSideGD
 *
 * @uses sfImageTransformAbstract
 * @package ExpressAccount
 * @subpackage transforms
 * @author Sensio Labs
 */
class sfImageResizeSmallestSideAndCropGD extends sfImageTransformAbstract
{
  /**
   * width
   *
   * @var integer
   */
  protected $width = null;

  /**
   * height
   *
   * @var integer
   */
  protected $height = null;

  /**
   * __construct
   *
   * @param integer $width
   * @param integer $height
   * @return
   */
  public function __construct($width, $height)
  {
    $this->setWidth($width);
    $this->setHeight($height);
  }

  /**
   * getWidth
   *
   * @return integer
   */
  public function getWidth()
  {
    return $this->width;
  }

  /**
   * setWidth
   *
   * @param integer $width
   */
  public function setWidth($width)
  {
    $this->width = (int) $width;
  }

  /**
   * getHeight
   *
   * @return integer
   */
  public function getHeight()
  {
    return $this->height;
  }

  /**
   * setheight
   *
   * @param integer $height
   */
  public function setHeight($height)
  {
    $this->height = (int) $height;
  }

  /**
   * transform
   *
   * @param sfImage $image
   * @return
   */
  protected function transform(sfImage $image)
  {
    $imageWidth  = $image->getWidth();
    $imageHeight = $image->getHeight();
    $finalWidth  = 0;
    $finalHeight = 0;

    if ($imageWidth > $imageHeight)
    {
      $ratio = $imageHeight / $this->getHeight();
      $finalHeight = $this->getHeight();
      $finalWidth  = $imageWidth / $ratio;
    }
    else
    {
      $ratio = $imageWidth / $this->getWidth();
      $finalHeight = $imageHeight / $ratio;
      $finalWidth  = $this->getWidth();
    }

    $image->resizeSimple($finalWidth, $finalHeight)
          ->crop(0, 0, $this->getWidth(), $this->getHeight());

    return $image;
  }
}
