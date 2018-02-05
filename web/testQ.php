

<?php
/**
 * Animal
*/
class Animal
{
	protected $name;

	public function __construct ($name){
		$this->name = $name;
	}


	 /**
     * Get name
     *
     * @return string
     */
	public function getName (){
	 
       return $this->name;
   
	}
}


/**
 * Cat
*/
class Cat extends Animal
{
	public function meow(){
		return "Cat $this->name is sayig meow";
	}

}

$cat = new Cat ('garfield');
echo ( $cat->getName() ); 
echo ( $cat->meow() );