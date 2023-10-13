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
import auxiliary.Verification;
import jakarta.servlet.http.HttpServletResponse;
import squadrom.models.Showcase;
import squadrom.models.User;

@Controller
@RequestMapping("/cabinet")
public class Cabinet {

    @GetMapping("") public String cabinet_get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Кабинет - Squadrom", true));
        controller_main.get_data();
        controller_main.save();
        if(!controller_main.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }


    @GetMapping("/edit") public String edit_get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Кабинет - Squadrom", true));
        controller_main.get_data();
        controller_main.save();
        if(!controller_main.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }
    @PostMapping("/edit") public String edit_post (
            @RequestParam(required = false, value = "reset_login") String reset_login,
            @RequestParam(required = false, value = "reset_email") String reset_email,
            @RequestParam(required = false, value = "reset_avatar") MultipartFile reset_avatar,
            @RequestParam(required = false, value = "reset_password") String reset_password
        ) {

        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🔴Не верные данные - Squadrom", false));
        controller_main.get_data();

        boolean key = reset_login != "" && reset_email != "" && reset_avatar.isEmpty() && reset_password != "";
        if(key) {

            if(!reset_login.equals(""))     { controller_main.user.set_login(reset_login); }
            if(!reset_email.equals(""))     { controller_main.user.set_mail(reset_email); }
            if(!reset_avatar.isEmpty())              { controller_main.user.set_link_avatar(controller_main.user.get_cookie_token(), reset_avatar); }
            if(!reset_password.equals(""))  { controller_main.user.set_password(reset_password); }

            controller_main.user.set_title("🟢Кабинет - Squadrom");
        }

        controller_main.save();
        return "cabinet";
    } 


    @GetMapping("/add_product") public String add_product_get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Кабинет - Squadrom", true));
        controller_main.get_data();
        controller_main.save();
        if(!controller_main.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }
    @PostMapping("/add_product") public String add_product_post (
            @RequestParam(required = false, value = "product_title") String product_title,
            @RequestParam(required = false, value = "product_desc") String product_desc,
            @RequestParam(required = false, value = "product_price") int product_price,
            // @RequestParam(required = false, value = "reset_password") MultipartFile product_img
            @RequestParam(required = false, value = "product_quantity") int product_quantity
        ) {

        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🔴Не верные данные - Squadrom", false));
        controller_main.get_data();

        try {
            String product_post = controller_main.get_request().getParameter("login_enter");
            boolean key = product_title != "null" && product_desc != "null" && product_price != 0 && product_quantity != 0;
            if(product_post.equals("Разместить") && key) {
                new Showcase().set_showcase(
                    controller_main.user.get_id(),
                    product_title,
                    product_desc,
                    product_price,
                    null,
                    null,
                    product_quantity
                );
            }

            controller_main.save();
            return "cabinet";
        }
        catch(Exception e) { }

        controller_main.save();
        return "index";
    }


    @GetMapping("/favourite") public String favourite_get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Избранное - Squadrom", true));
        controller_main.get_data();
        controller_main.save();
        if(!controller_main.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }


    @GetMapping("/exit") public String exit_get() {
        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Кабинет - Squadrom", true));
        controller_main.get_data();
        controller_main.save();
        if(!controller_main.user.get_authorized()) { return "index"; }
        else { return "cabinet"; }
    }
    @PostMapping("/exit") public String exit_post (
        @Autowired HttpServletResponse response,
        @RequestParam(required = true, value = "profile_delete_account", defaultValue = "null") String profile_delete_account) {

        Controller_main controller_main = new Controller_main();
        controller_main.set_user(new User("🟢Squadrom", false));
        controller_main.get_data();

        // Удаление cookie
        Verification verification = new Verification();
        verification.remove_cookie(controller_main);

        // Удаление папки и ее содержимого
        if(!profile_delete_account.equals("null")) {
            try {
                Files.walk(Paths.get(panel.path_upload + panel.path_users + "/" + controller_main.user.get_cookie_token()))
                    .sorted(Comparator.reverseOrder())
                    .map(Path::toFile)
                    .forEach(File::delete);
            }
            catch(IOException e) { print.error("[Delete_folder]"); }

            // Удаление из базы данных
            controller_main.user.delete_user();
        }

        controller_main.save();
        return "index";
    }

}