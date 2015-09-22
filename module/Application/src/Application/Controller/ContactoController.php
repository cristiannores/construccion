<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Debug\Debug;
use Zend\Mail\Message;
use Zend\Mime\Message as Message2;
use Zend\Mime\Part;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactoController extends AbstractActionController
{
    public function mailAction()
    {
       $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
       $renderer->inlineScript()->prependFile('/js/modulos/Contacto/contacto.js');
//        \Zend\Debug\Debug::dump("llega");
        return new ViewModel();
    }
    
    public function enviarMensajeAction(){
        
//        \Zend\Debug\Debug::dump($this->params()->fromPost());exit;
        $nombre = $this->params()->fromPost("nombre");
        $correo = $this->params()->fromPost("correo");
        $mensaje = $this->params()->fromPost("mensaje");
        
        $transport = $this->getServiceLocator()->get('mail.transport');
    		$message = new Message();
    		$this->getRequest()->getServer();  //Server vars
    		$message->addTo("no-reply@jyj.cl")
    		->addFrom("no-reply@jyj.cl")
    		->setSubject('Contacto desde pagina web');
                
                $html = '';


                $bodyPart = new Message2();

                $bodyMessage = new Part("Mensaje de $nombre desde el sitio web,"
                        . "<br>"
                        . "Contenido mensaje: <br> ".$mensaje );
                $bodyMessage->type = 'text/html';

                $bodyPart->setParts(array($bodyMessage));
                $message->setBody($bodyPart)
                        ->setEncoding('UTF-8');
                $transport->send($message);
                
                
         Debug::dump($this->params()->fromPost());exit;
        
    }
}
