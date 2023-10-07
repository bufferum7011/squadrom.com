package squadrom.models;
import static squadrom.beans.Panel.*;
import java.sql.ResultSet;
import java.util.List;

public class Showcase {

    private int id;
    private int seller;
    private String name;
    private String description;
    private int price;
    // private Json img;
    private String type;
    private int number_likes;
    private int number_views;
    private String date;
    private int quantity;

    public int get_id()             { return id; }
    public int get_seller()         { return seller; }
    public String get_name()        { return name; }
    public String get_description() { return description; }
    public int get_price()          { return price; }
    // public String[] get_img()       { return img; }
    public String get_type()        { return type; }
    public int get_number_likes()   { return number_likes; }
    public int get_number_views()   { return number_views; }
    public String get_date()        { return date; }
    public int get_quantity()       { return quantity; }

    public void set_id(int id)                      { this.id = id; }
    public void set_seller(int seller)              { this.seller = seller; }
    public void set_name(String name)               { this.name = name; }
    public void set_description(String description) { this.description = description; }
    public void set_price(int price)                { this.price = price; }
    // public void set_img(String[] img)               { this.img = img; }
    public void set_type(String type)               { this.type = type; }
    public void set_number_likes(int number_likes)  { this.number_likes = number_likes; }
    public void set_number_views(int number_views)  { this.number_views = number_views; }
    public void set_date(String date)               { this.date = date; }
    public void set_quantity(int quantity)          { this.quantity = quantity; }

    public Showcase() {}
    private List<Showcase> list_showcase;
    public List<Showcase> get_list_showcase() {

        try {
            list_showcase.clear();
            ResultSet result = sql.sql_callback("SELECT * FROM showcase;");
            while(result.next()) {
                Showcase showcase = new Showcase();

                showcase.set_id             (result.getInt("id"));
                showcase.set_seller         (result.getInt("seller"));
                showcase.set_name           (result.getString("name"));
                showcase.set_description    (result.getString("description"));
                showcase.set_price          (result.getInt("price"));
                // img = result.getString("img"));
                showcase.set_type           (result.getString("type"));
                showcase.set_number_likes   (result.getInt("number_likes"));
                showcase.set_number_views   (result.getInt("number_views"));
                showcase.set_date           (result.getString("date"));
                showcase.set_quantity       (result.getInt("quantity"));

                list_showcase.add(showcase);
            }
        }
        catch(Exception e) { print.error("[Showcase]"); }
        return list_showcase;
    }
    public void set_showcase(Showcase showcase) {
        sql.sql_update("INSERT INTO showcase (seller, name, description, price, type, number_likes, number_views, date, quantity) VALUES(" +
            showcase.get_seller() + ", '" +
            showcase.get_name() + "', '" +
            showcase.get_description() + "', " +
            showcase.get_price() + ", '" +
            showcase.get_type() + "', " +
            showcase.get_number_likes() + ", " +
            showcase.get_number_views() + ", '" +
            showcase.get_date() + "', " +
            showcase.get_quantity() + ");"
        );
    }

}