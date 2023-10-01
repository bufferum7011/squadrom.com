package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.ServletRequestAttributes;
import jakarta.servlet.http.Cookie;
import squadrom.beans.User;

@Controller
public class Main_controller {

    public Main_controller() { }
    public Main_controller(String title) {

        request = ((ServletRequestAttributes) RequestContextHolder.currentRequestAttributes()).getRequest();
        user.title = title;
        user.authorized = false;

        // уточняю авторизацию (взможно там не мой токен)
        Cookie[] cookies = request.getCookies();
        for(int i = 0; cookies != null && cookies[i].getName().equals(panel.cookie_name); i++) {

            user.cookie_token = cookies[i].getValue();
            user.authorized = true;
        }

        if(user.need_check && !user.authorized) {

            print.debag("ЗАПРЕЩАЮ");
            // try {
            //     response.getWriter().println("<script>window.confirm('Вы ещё не зарегистрировались.');</script>");
            // } catch (IOException e) {
            //     e.printStackTrace();
            // }
        }

        new User();
        request.setAttribute("user", user);
    }

    @GetMapping("/{unknown_1}")
    public String unknown_1(@PathVariable(value = "unknown_1") String unknown_1) {
        new Main_controller("🔴Такой страницы нет");
        return "index";
    }

    @GetMapping("/{unknown_1}/{unknown_2}")
    public String unknown_2(@PathVariable(value = "unknown_1") String unknown_1) {
        new Main_controller("🔴Такой страницы нет");
        return "index";
    }

    @GetMapping("/{unknown_1}/{unknown_2}/{unknown_3}")
    public String unknown_3(@PathVariable(value = "unknown_1") String unknown_1) {
        new Main_controller("🔴Такой страницы нет");
        return "index";
    }

}