package squadrom.beans;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.AnnotationConfigApplicationContext;
import org.springframework.stereotype.Component;
import auxiliary.Print;
import jakarta.annotation.PostConstruct;
import jakarta.annotation.PreDestroy;

@Component
public class Panel {

    // variables
    @Value("${mysql.server}")   public String mysql_server;
    @Value("${mysql.user}")     public String mysql_user;
    @Value("${mysql.password}") public String mysql_password;
    @Value("${server.project}") public String server_project;
    @Value("${server.ip}")      public String server_ip;
    @Value("${cookie_name}")    public String cookie_name;
    @Value("${cookie_salt}")    public String cookie_salt;
    @Value("${path_upload}")    public String path_upload;
    @Value("${path_users}")     public String path_users;

    public static AnnotationConfigApplicationContext context;
    public static Panel panel;
    public static Print print = new Print();
    public static auxiliary.Exec_sql sql;

    @PostConstruct 
    public void _init() {
        print._init("PANEL");
    }
    @PreDestroy
    public void _dest() {
        print._dest("PANEL");
    }

}