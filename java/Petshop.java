class Petshop {

    // atribut-atribut private
    private int id;
    private String name;
    private String category;
    private int price;

    // constructor kosong
    Petshop() {
        this.id = -1;
        this.name = "";
        this.category = "";
        this.price = -1;
    }

    // constructor dengan parameter
    Petshop(int id, String name, String category, int price) {
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
    }

    // getter dan setter untuk id
    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }

    // getter dan setter untuk name
    public void setName(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    // getter dan setter untuk name
    public void setCategory(String category) {
        this.category = category;
    }

    public String getCategory() {
        return category;
    }

    // getter dan setter untuk price
    public void setPrice(int price) {
        this.price = price;
    }

    public int getPrice() {
        return price;
    }
}
