# import class
from Petshop import Petshop
# import library untuk clearscreen
import os

# break menu
end = 0;

# list kosong untuk menyimpan object
products = [];

# looping menu utama
while (end == 0):
    os.system("cls")
    print("Petshop Dudul Miaw-miaw")
    print("(1) Menampilkan Data")
    print("(2) Menambahkan Data")
    print("(3) Mengubah Data")
    print("(4) Menghapus Data")
    print("(5) Mencari Data dengan Nama")
    print("(6) Keluar")
    
    menu = int(input(">> Pilih Menu: "))
    os.system("cls")
    
    # nested if
    # menampilkan produk
    if menu == 1:
        if not products:
            print("Data Kosong")
        else:
            no = 1;
            for no, product in enumerate(products, 1):
                print(f"{no}. {product.getId()} {product.getName()} {product.getCategory()} {product.getPrice()}")
        
        # tunggu enter
        input("Tekan Enter untuk kembali...")
        
    # menambah produk
    elif menu == 2:
        print("Tambah Produk Petshop Dudul Miaw-miaw");
        
        # input data baru
        new_id = int(input("Masukan ID: "))
        new_name = input("Masukan Nama: ")
        new_category = input("Masukan Kategori: ")
        new_price = int(input("Masukan Harga: "))
        
        # buat object dengan parameter dan langsung append ke list
        products.append(Petshop(new_id, new_name, new_category, new_price))
        
        print("Produk ditambahkan")
        
        input("Tekan Enter untuk kembali...")
    
    # edit produk
    elif menu == 3:
        print("Edit Produk Petshop Dudul Miaw-miaw");
        
        # input id yang akan diubah
        keyword = int(input("Masukan ID yang ingin diubah: "))
        i = found = 0;
        
        # mencari produk
        while (i < len(products)) and (found == 0):
            if products[i].getId() == keyword:
                found = 1
            else:
                i+= 1
        
        # jika tidak ketemu
        if(found == 0):
            print("Produk tidak ditemukan")
        # jika ketemu input data baru
        else:
            new_name = input("Masukan Nama: ")
            new_category = input("Masukan Kategori: ")
            new_price = int(input("Masukan Harga: "))
            
            # edit setiap atribut dengan method set
            products[i].setName(new_name)
            products[i].setCategory(new_category)
            products[i].setPrice(new_price)
            
            print("Produk diubah")
        
        input("Tekan Enter untuk kembali...")
    # hapus produk
    elif menu == 4:
        print("Hapus Produk Petshop Dudul Miaw-miaw");
        
        # input id yang akan dihapus
        keyword = int(input("Masukan ID yang ingin diubah: "))
        i = found = 0;
        
        # mencari produk
        while (i < len(products)) and (found == 0):
            if products[i].getId() == keyword:
                found = 1
            else:
                i+= 1
        
        # jika tidak ketemu
        if(found == 0):
            print("Produk tidak ditemukan")
        # jika ada hapus dari list
        else:
            products.remove(products[i])
            
            print("Produk dihapus")
        
        input("Tekan Enter untuk kembali...")
    # cari produk
    elif menu == 5:
        print("Cari Produk Petshop Dudul Miaw-miaw");
        
        # input id yang akan dicari
        keyword = input("Masukan Nama Produk yang ingin dicari: ")
        i = found = 0;
        
        # mencari produk dan tampilkan setiap produk yang sesuai
        no = 1;
        while (i < len(products)):
            if products[i].getName() == keyword:
                print(f"{no}. {products[i].getId()} {products[i].getName()} {products[i].getCategory()} {products[i].getPrice()}")
                found = 1
                no+=1
            i+= 1
        
        # jika tidak ketemu
        if(found == 0):
            print("Produk tidak ditemukan")
        # jika ada
        else:
            print("Produk ditemukan")
        
        input("Tekan Enter untuk kembali...")
    
    # keluar menu
    elif menu == 6:
        end = 1;
        print("Keluar...")
    else:
        print("Menu tidak ada")
        input("Tekan Enter untuk kembali...")
        
    