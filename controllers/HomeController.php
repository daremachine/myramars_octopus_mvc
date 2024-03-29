<?php declare(strict_types=1);

class HomeController extends BaseController
{
    public function Index()
    {
        $this->metadata = new ContextMetadata("Domu", "SEO description of home.", "SEO keywords");
        
        /* or 
            $result = new \stdClass();
            $result->cars = (new Vehicles())->getCargos();
        */

        return (new Vehicles())->getCargos();
    }

    public function Contact()
    {
        $this->layout = "@secondLayout";
        $this->metadata = new ContextMetadata("Kontakty", "SEO description of contacts.", "SEO keywords");

        $result = new \stdClass();
        $result->form = new ContactForm();

        // POST
        if($this->request->isPost()) {
            $formData = $this->request->getPostData();
            $result->form = new ContactForm($formData);

            if(!$result->form->isValid()) {
                $result->errorMessage = "Formulář není správně vyplněn.";
                var_dump($result); #die;
                return $result;
            }

            $result->form = new ContactForm();
            $result->successMessage = "Formulář byl odeslán.";
            var_dump('send');

            //die;
        }

        return $result;
    }
}