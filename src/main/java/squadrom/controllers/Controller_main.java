package squadrom.controllers;
import static squadrom.beans.Panel.*;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.ServletRequestAttributes;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.models.User;
import squadrom.switchs.Notification;

public class Controller_main {

    private HttpServletRequest request;
    private HttpServletResponse response;

    public HttpServletRequest get_request() { return request; }
    public HttpServletResponse get_response() { return response; }

    public void set_request_attributes() {
        this.request = ((ServletRequestAttributes) RequestContextHolder.currentRequestAttributes()).getRequest();
        this.response = ((ServletRequestAttributes) RequestContextHolder.currentRequestAttributes()).getResponse();
    }


    public User user;
    public Notification notification;
    public Controller_main() { }
    public void set_user(User user) { this.user = user; }
    public void set_notification(Notification notification) { this.notification = notification; }
    public void get_data() {

        set_request_attributes();
        user.set_authorized(false);
        user.set_link_avatar("/img_sys/default_avatar.webp");

        // Сверка cookie и сбор данных из bd при регистрации
        Cookie[] cookies = get_request().getCookies();
        if(cookies != null) {
            for(int i = 0; cookies.length > i; i++) {
                if(cookies[i].getName().equals(panel.cookie_name)) {
                    user.set_cookie_token(cookies[i].getValue());
                    user.set_authorized(true);
                    user = user.data_base(user);
                }
            }
        }
    }
    public void save() {

        // Запрет на cabinet
        if(user.get_need_check() && !user.get_authorized()) {
            print.debag("[Запрещаю вход в cabinet]");
            // try { get_response().getWriter().println("<script>call_up_condition_register();</script>"); }
            // catch(IOException e) { e.printStackTrace(); }
        }

        // Формироваиние ответа
        get_request().setAttribute("user", user);
        get_request().setAttribute("notification", notification);
    }

}