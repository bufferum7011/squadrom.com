package auxiliary;
import static squadrom.beans.Panel.*;
import java.io.File;
import java.io.IOException;
import org.springframework.util.FileCopyUtils;
import org.springframework.web.multipart.MultipartFile;
public class Manager_file {

    public String upload_avatar(String cookie_token, MultipartFile link_avatar) {

        try {
            String upload_path_full = panel.path_upload + panel.path_users + "/" + cookie_token;
            String path_result =                          panel.path_users + "/" + cookie_token + "/avatar.webp";

            // Создаем директорию, если её не существует
            File file = new File(upload_path_full);
            if(!file.exists()) { file.mkdirs(); }

            // Передаем содержимое загруженного файла в целевой файл на сервере
            FileCopyUtils.copy(link_avatar.getBytes(), new File(upload_path_full + "/avatar.webp"));

            return path_result;
        }
        catch(IOException e) { return "/img_sys/default_avatar.webp"; }
    }

}