package squadrom.controllers;
import static squadrom.beans.Panel.*;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.Comparator;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;

import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.models.User;

@Controller
@RequestMapping("/cabinet")
public class Cabinet {

    @GetMapping("")
    public String get() {

        print.debag("[/cabinet]");
        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Кабинет - Squadrom", true));
        main_controller.get_data();
        main_controller.save_data();
        if(!main_controller.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }

    @PostMapping("/edit")
    public String post_edit (
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, value = "reset_login") String reset_login,
        @RequestParam(required = true, value = "reset_email") String reset_email,
        @RequestParam(required = true, value = "reset_avatar") MultipartFile reset_avatar,
        @RequestParam(required = true, value = "reset_password") String reset_password) {

        print.debag("[/cabinet/edit]");
        Main_controller main_controller = new Main_controller();
        main_controller.set_response(response);
        main_controller.set_user(new User("🟢Кабинет - Squadrom", false));
        main_controller.get_data();

        if( reset_login == "" &&
            reset_email == "" &&
            reset_avatar.isEmpty() &&
            reset_password == "") {

            main_controller.user.set_title("🔴Не верные данные - Squadrom");
            main_controller.save_data();
            return "cabinet";
        }
        else {

            if(!reset_login.equals(""))     { main_controller.user.set_login(reset_login); }
            if(!reset_email.equals(""))     { main_controller.user.set_mail(reset_email); }
            if(!reset_avatar.isEmpty())              { main_controller.user.set_link_avatar(main_controller.user.get_cookie_token(), reset_avatar); }
            if(!reset_password.equals(""))  { main_controller.user.set_password(reset_password); }

            main_controller.save_data();
            return "cabinet";
        }
    }

    @PostMapping("/exit")
    public String post_profile_delete_account (
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, value = "profile_delete_account", defaultValue = "null") String profile_delete_account) {

        print.debag("[/cabinet/exit]");
        // Удаление cookie
        Cookie cookie = new Cookie(panel.cookie_name, null);
        cookie.setMaxAge(0);
        cookie.setPath("/");

        Main_controller main_controller = new Main_controller();
        main_controller.set_user(new User("🟢Squadrom", false));
        main_controller.set_response(response);
        main_controller.get_data();
        main_controller.get_response().addCookie(cookie);

        // Удаление папки и ее содержимого
        if(!profile_delete_account.equals("null")) {
            try {
                Files.walk(Paths.get(panel.path_upload + panel.path_users + "/" + main_controller.user.get_cookie_token()))
                    .sorted(Comparator.reverseOrder())
                    .map(Path::toFile)
                    .forEach(File::delete);
            }
            catch(IOException e) { print.error("[Delete_folder]"); }

            // Удаление из базы данных
            main_controller.user.delete_user();
        }
        main_controller.save_data();

        return "redirect:/";
    }

}