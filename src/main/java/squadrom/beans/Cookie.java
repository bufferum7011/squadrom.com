package squadrom.beans;
import javax.servlet.http.Cookie;

public class Cookie {

    private static final String NAME_COOKIE = "squadrom_token";
    
    public static String get_cookie() {
        Cookie cookie = new Cookie(NAME_COOKIE, "igor_9000");

        return null;
    }
}