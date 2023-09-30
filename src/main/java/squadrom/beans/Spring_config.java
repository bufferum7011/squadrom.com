package squadrom.beans;
import org.springframework.boot.web.servlet.ServletRegistrationBean;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.DependsOn;
import org.springframework.context.annotation.PropertySource;
import org.springframework.context.annotation.Scope;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.RequestContextListener;
import org.springframework.web.context.request.ServletRequestAttributes;
import org.springframework.web.servlet.DispatcherServlet;
import org.springframework.web.servlet.config.annotation.ResourceHandlerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;
import jakarta.servlet.http.HttpServletRequest;
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

    @Override
    public void addResourceHandlers(ResourceHandlerRegistry registry) {
        registry.addResourceHandler("/**").addResourceLocations("classpath:/static/");
    }

    // @Bean
    // @Scope("prototype")
    // public HttpServletRequest request_2() {
    //     return ((ServletRequestAttributes) RequestContextHolder.currentRequestAttributes()).getRequest();
    // }

    // @Bean
    // public DispatcherServlet dispatcherServlet() {
    //     return new DispatcherServlet();
    // }

    // @Bean
    // public ServletRegistrationBean<DispatcherServlet> servletRegistrationBean() {
    //     ServletRegistrationBean<DispatcherServlet> registrationBean = new ServletRegistrationBean<>(dispatcherServlet(), "/");
    //     registrationBean.setLoadOnStartup(1);
    //     return registrationBean;
    // }

    // @Bean
    // public RequestContextListener requestContextListener() {
    //     return new RequestContextListener();
    // }

}