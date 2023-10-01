package squadrom;
import static squadrom.beans.Panel.*;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.AnnotationConfigApplicationContext;

@SpringBootApplication
public class SquadromApplication {

    public static void main(String[] args) {

        SpringApplication.run(SquadromApplication.class, args);
        // pulling out bean from the pool
        context =           new AnnotationConfigApplicationContext(squadrom.beans.Spring_config.class);
        panel =             context.getBean("panel", squadrom.beans.Panel.class);
        sql =               context.getBean("sql", squadrom.models.Exec_sql.class);
        user =              context.getBean("user", squadrom.beans.User.class);
    }

}
