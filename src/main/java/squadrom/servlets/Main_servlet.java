package squadrom.servlets;
import static squadrom.beans.Panel.*;
import java.io.IOException;
import jakarta.annotation.PostConstruct;
import jakarta.annotation.PreDestroy;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

// @WebServlet
public class Main_servlet { // extends HttpServlet

    @PostConstruct
    public void _init() {
        print._init("My_servlet");
    }
    @PreDestroy
    public void _dest() {
        print._dest("My_servlet");
    }

    // @Override
    // protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    //     if(request.getRequestURI().equals("/servlets/Main_servlet")) {
    //         response.setContentType("text/html");
    //         response.getWriter().print("index");
    //     }
    //     else {
    //         print.error("ОШИБКА ИЗ СЕРВЛЕТА");
    //         throw new IllegalStateException("ОШИБКА ИЗ СЕРВЛЕТА");
    //     }
    // }

    // @Override
    // protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
    //     super.doPost(req, resp);
    // }
    
}