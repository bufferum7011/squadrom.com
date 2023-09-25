package squadrom.models;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Post {
    
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private long id;
    private String name, tag;
    private int age, weight;
    
    public long getId() { return id; }
    public String getTag() { return tag; }
    public String getName() { return name; }
    public int getAge() { return age; }
    public int getWeight() { return weight; }


    public void setId(long id) { this.id = id; }
    public void setTag(String tag) { this.tag = tag; }
    public void setName(String name) { this.name = name; }
    public void setAge(int age) { this.age = age; }
    public void setWeight(int weight) { this.weight = weight; }


    public Post() {}
    public Post(int age, String name, int weight) {
        this.age = age;
        this.name = name;
        this.weight = weight;
    }
}