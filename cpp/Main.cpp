#include <bits/stdc++.h>

#include "Petshop.cpp"

using namespace std;

int main()
{
    // untuk break menu
    int end = 0;

    // vector untuk objek-objek
    vector<Petshop> products;

    // looping menu
    while (end != 1)
    {
        // clear screen dan menampilkan menu
        system("cls");
        cout << "Petshop Dudul Miaw-miaw" << endl;
        cout << "(1) Menampilkan Data" << endl;
        cout << "(2) Menambahkan Data" << endl;
        cout << "(3) Mengubah Data" << endl;
        cout << "(4) Menghapus Data" << endl;
        cout << "(5) Mencari Data dengan Nama" << endl;
        cout << "(6) Keluar" << endl;
        cout << ">> Pilih Menu: ";

        // input menu
        int menu = 0;
        cin >> menu;
        cin.ignore(); // ignore inputan terakhir (untuk nunggu enter)

        system("cls"); // clear screen

        // switch menu
        switch (menu)
        {
        case 1:
        {
            // menampilkan produk
            cout << "List Produk Petshop Dudul Miaw-miaw" << endl;

            // jika produk kosong
            if (products.empty())
            {
                cout << "Data kosong" << endl;
            }
            else
            {
                // jika produk ada tampilkan seluruh data
                int no = 1;
                for (vector<Petshop>::iterator i = products.begin(); i != products.end(); i++, no++)
                {
                    cout << no << ". " << i->getId() << " " << i->getName() << " " << i->getCategory() << " " << i->getPrice() << endl;
                }
            }

            // menunggu enter
            cout << "Tekan Enter untuk kembali...";
            cin.get();
            break;
        }
        case 2:
        {
            // menambah produk
            cout << "Tambah Produk Petshop Dudul Miaw-miaw" << endl;

            // variabel untuk atribut
            int id, price;
            string name, category;

            // input
            cout << "Masukan ID: ";
            cin >> id;
            cout << "Masukan Nama: ";
            cin >> name;
            cout << "Masukan Kategori: ";
            cin >> category;
            cout << "Masukan Harga: ";
            cin >> price;

            // buat objek langsung dengan parameter
            Petshop temp(id, name, category, price);

            // push ke vector
            products.push_back(temp);

            cout << "Produk ditambahkan" << endl;

            // menunggu enter
            cout << "Tekan Enter untuk kembali...";
            cin.ignore();
            cin.get();
            break;
        }
        case 3:
        {
            // edit produk
            cout << "Edit Produk Petshop Dudul Miaw-miaw" << endl;

            // input id
            int id;
            cout << "Masukan ID yang ingin diubah: ";
            cin >> id;

            // mencari data
            vector<Petshop>::iterator i = products.begin();
            int found = 0;

            while ((i != products.end()) && (found == 0))
            {
                if (i->getId() == id)
                {
                    found = 1;
                }
                else
                {
                    i++;
                }
            }

            // jika tidak ketemu
            if (found == 0)
            {
                cout << "Produk tidak ditemukan" << endl;
            }
            else
            {
                // jika ketemu input data
                int price;
                string name, category;
                cout << "Masukan Nama: ";
                cin >> name;
                cout << "Masukan Kategori: ";
                cin >> category;
                cout << "Masukan Harga: ";
                cin >> price;

                // update setiap atribut ke object
                i->setName(name);
                i->setCategory(category);
                i->setPrice(price);

                cout << "Produk diubah" << endl;
            }

            // menunggu enter
            cout << "Tekan Enter untuk kembali...";
            cin.ignore();
            cin.get();
            break;
        }
        case 4:
        {
            // hapus produk
            cout << "Hapus Produk Petshop Dudul Miaw-miaw" << endl;

            // input id
            int id;
            cout << "Masukan ID yang ingin dihapus: ";
            cin >> id;

            // mencari data yang akan dihapus
            vector<Petshop>::iterator i = products.begin();
            int found = 0;

            while ((i != products.end()) && (found == 0))
            {
                if (i->getId() == id)
                {
                    found = 1;
                }
                else
                {
                    i++;
                }
            }

            // jika tidak ketemu
            if (found == 0)
            {
                cout << "Produk tidak ditemukan" << endl;
            }
            else
            {
                // jika ketemu hapus
                products.erase(i);
                cout << "Produk dihapus" << endl;
            }

            // menunggu enter
            cout << "Tekan Enter untuk kembali...";
            cin.ignore();
            cin.get(); // Menunggu pengguna menekan Enter
            break;
        }
        case 5:
        {
            // cari produk dengan nama
            cout << "Cari Produk Petshop Dudul Miaw-miaw" << endl;

            // input nama
            string name;
            cout << "Masukan Nama Produk yang ingin dicari: ";
            cin >> name;

            // mencari data sesuai nama
            vector<Petshop>::iterator i = products.begin();
            int found = 0;

            while ((i != products.end()) && (found == 0))
            {
                if (i->getName() == name)
                {
                    found = 1;
                }
                else
                {
                    i++;
                }
            }

            // jika tidak ketemu
            if (found == 0)
            {
                cout << "Produk tidak ditemukan" << endl;
            }
            else
            {
                // tampilkan jika ketemu
                cout << i->getId() << " " << i->getName() << " " << i->getCategory() << " " << i->getPrice() << endl;
                cout << "Produk ditemukan" << endl;
            }

            // menunggu enter
            cout << "Tekan Enter untuk kembali...";
            cin.ignore();
            cin.get(); 
            break;
        }
        case 6:
        {
            // keluar menu
            end = 1;
            cout << "Keluar..." << endl;
            break;
        }
        default:
        {
            // default
            cout << "Menu tidak ada" << endl;
            break;
        }
        }
    }

    return 0;
}