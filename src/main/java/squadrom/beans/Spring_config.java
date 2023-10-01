package squadrom.beans;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.DependsOn;
import org.springframework.context.annotation.PropertySource;
import org.springframework.context.annotation.Scope;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import squadrom.models.Exec_sql;

@Configuration
@ComponentScan({"squadrom"})
@PropertySource("classpath:application.properties")
public class Spring_config implements WebMvcConfigurer {

    @Bean
    @Scope("singleton")
    public Panel panel() {
        return new Panel();
    }

    @Bean
    @Scope("singleton")
    @DependsOn({"panel"})
    public Exec_sql sql() {
        return new Exec_sql();
    }

    @Bean
    @Scope("prototype")
    @DependsOn({"sql"})
    public User user() {
        return new User();
    }

}