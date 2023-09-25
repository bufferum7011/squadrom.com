package squadrom;
import static squadrom.Panel.*;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.builder.SpringApplicationBuilder;
import org.springframework.boot.web.servlet.support.SpringBootServletInitializer;
import org.springframework.context.annotation.AnnotationConfigApplicationContext;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.DependsOn;
import org.springframework.context.annotation.PropertySource;
import org.springframework.context.annotation.Scope;
import auxiliary.Exec_sql;
import auxiliary.Print;

@SpringBootApplication
public class SquadromApplication {

    public static void main(String[] args) {

        SpringApplication.run(SquadromApplication.class, args);

        // pulling out bean from the pool
        context =           new AnnotationConfigApplicationContext(Spring_config.class);
        panel =             context.getBean("panel", squadrom.Panel.class);
        print =             context.getBean("print", auxiliary.Print.class);
        sql =               context.getBean("sql", auxiliary.Exec_sql.class);
        print.result("[Panel] - ON\n");

    }

}

class ServletInitializer extends SpringBootServletInitializer {

	@Override protected SpringApplicationBuilder configure(SpringApplicationBuilder application) {
		return application.sources(SquadromApplication.class);
	}

}

@Configuration
@ComponentScan({"squadrom", "auxiliary"})
@PropertySource("classpath:application.properties")
class Spring_config {

    @Bean
    @Scope("singleton")
    public Panel panel() {
        new Print().result("[Panel] - NEW\n");
        return new Panel();
    }

    @Bean
    @Scope("singleton")
    @DependsOn("panel")
    public Print print() {
        new Print().result("[Print] - NEW\n");
        return new Print();
    }

    @Bean
    @Scope("singleton")
    @DependsOn({"panel", "print"})
    public Exec_sql sql() {
        new Print().result("[Exec_sql] - NEW\n");
        return new Exec_sql();
    }

}