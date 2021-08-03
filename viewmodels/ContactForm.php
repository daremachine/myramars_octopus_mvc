<?php declare(strict_types=1);

class ContactForm implements IForm
{
    public $name = null;
    public $phone = null;
    public $note = null;

    public function __construct($formData = null)
    {
        $this->name = ($formData != null) ? $formData->name : null;
        $this->phone = ($formData != null) ? $formData->phone : null;
        $this->note = ($formData != null) ? $formData->note : null;
    }

    public function isValid(): bool
    {
        if($this->name == null) return false;
        if($this->phone == null) return false;
        if($this->note == null) return false;
        return true;
    }
}