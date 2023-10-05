package squadrom.beans;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.DependsOn;
import org.springframework.context.annotation.PropertySource;
import org.springframework.context.annotation.Scope;
import org.springframework.web.servlet.ViewResolver;
import org.springframework.web.servlet.config.annotation.ResourceHandlerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import org.thymeleaf.spring6.SpringTemplateEngine;
import org.thymeleaf.spring6.view.ThymeleafViewResolver;
import org.thymeleaf.templateresolver.ClassLoaderTemplateResolver;
import auxiliary.Exec_sql;

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

    @Override
    public void addResourceHandlers(ResourceHandlerRegistry registry) {

        registry.addResourceHandler("/resources/**")
                .addResourceLocations(
                    "classpath:/static/",
                    "classpath:/templates/"
                );

        registry.addResourceHandler(
                    "/users/**"
                    // "/squadrom/src/**"
                )
                .addResourceLocations(
                    "classpath:/users/"
                    // "file:/users/"
                );

    }

    @Bean
    public ViewResolver viewResolver() {
        ClassLoaderTemplateResolver templateResolver = new ClassLoaderTemplateResolver();
        templateResolver.setTemplateMode("HTML");
        templateResolver.setPrefix("classpath:/templates/");
        templateResolver.setSuffix(".html");

        SpringTemplateEngine engine = new SpringTemplateEngine();
        engine.setTemplateResolver(templateResolver);

        ThymeleafViewResolver viewResolver = new ThymeleafViewResolver();
        viewResolver.setTemplateEngine(engine);
        return viewResolver;
    }

}