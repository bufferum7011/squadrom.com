package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestControllerAdvice;
import org.springframework.web.servlet.NoHandlerFoundException;
import squadrom.models.User;

// @RestControllerAdvice
public class Controller_error {

//     @ExceptionHandler(NoHandlerFoundException.class)
//     @ResponseStatus(HttpStatus.NOT_FOUND)
//     public String error(NoHandlerFoundException ex) {

//         print.debag("[ERRORUS_STATION]\n");

//         Controller_main controller_main = new Controller_main();
//         controller_main.set_user(new User("🔴Error - Squadrom", false));
//         controller_main.get_data();
//         controller_main.save();
//         return "error";
//     }

}