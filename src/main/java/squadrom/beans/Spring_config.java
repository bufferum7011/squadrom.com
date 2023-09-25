package squadrom.beans;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.DependsOn;
import org.springframework.context.annotation.PropertySource;
import org.springframework.context.annotation.Scope;
import auxiliary.Exec_sql;
import auxiliary.Print;

@Configuration
@ComponentScan({"squadrom", "auxiliary"})
@PropertySource("classpath:application.properties")
public class Spring_config {

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