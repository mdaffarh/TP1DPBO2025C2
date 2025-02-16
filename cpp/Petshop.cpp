#include <bits/stdc++.h>

using namespace std;

// kelas petshop
class Petshop
{
private:
    // atribut-atribut private
    int id;
    string name;
    string category;
    int price;

public:
    // konstruktor kosong
    Petshop()
    {
        this->id = -1;
        this->name = "";
        this->category = "";
        this->price = -1;
    }

    // konstruktor dengan parameter untuk mengisi atribut
    Petshop(int id, string name, string category, int price)
    {
        this->id = id;
        this->name = name;
        this->category = category;
        this->price = price;
    }

    // getter dan setter (ambil dan set atribut)
    // setter id
    void setId(int id)
    {
        this->id = id;
    }

    // getter id
    int getId()
    {
        return id;
    }

    // setter name
    void setName(string name)
    {
        this->name = name;
    }

    // getter name
    string getName()
    {
        return name;
    }

    // setter category
    void setCategory(string category)
    {
        this->category = category;
    }

    // getter category
    string getCategory()
    {
        return category;
    }

    // setter price
    void setPrice(int price)
    {
        this->price = price;
    }

    // getter price
    int getPrice()
    {
        return price;
    }

    ~Petshop()
    {
    }
};