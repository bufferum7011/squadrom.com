package squadrom.models;

public class Showcase {

    private int id;
    private int seller;
    private String name;
    private String description;
    private int price;
    private String[] img;
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
    public String[] get_img()       { return img; }
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
    public void set_img(String[] img)               { this.img = img; }
    public void set_type(String type)               { this.type = type; }
    public void set_number_likes(int number_likes)  { this.number_likes = number_likes; }
    public void set_number_views(int number_views)  { this.number_views = number_views; }
    public void set_date(String date)               { this.date = date; }
    public void set_quantity(int quantity)          { this.quantity = quantity; }



}