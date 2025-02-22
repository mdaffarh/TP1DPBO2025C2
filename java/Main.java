import java.util.ArrayList;
import java.util.Scanner;

class Main {
    public static void main(String[] args) {
        // instansiasi scanner
        Scanner scanner = new Scanner(System.in);

        // untuk break
        int end = 0;
        
        // buat arraylist untuk menyimpan object
        ArrayList<Petshop> products = new ArrayList<>();
        
        // looping menu utama
        while (end != 1) {
            // menampilkan menu
            System.out.println("=========================");
            System.out.println("Petshop Dudul Miaw-miaw");
            System.out.println("=========================");
            System.out.println("(1) Menampilkan Data");
            System.out.println("(2) Menambahkan Data");
            System.out.println("(3) Mengubah Data");
            System.out.println("(4) Menghapus Data");
            System.out.println("(5) Mencari Data dengan Nama");
            System.out.println("(6) Keluar");
            System.out.print(">> Pilih Menu: ");

            // input menu
            int menu = scanner.nextInt(); 

            // switch menu
            switch (menu) {
                // menampilkan produk
                case 1 -> {
                    System.out.println("List Produk Petshop Dudul Miaw-miaw");
                    
                    // jika kosong
                    if (products.isEmpty()) {
                        System.out.println("Data Kosong");
                    }else{
                        // jika ada tampilkan
                        int no = 1;
                        for (Petshop product : products) {
                            System.out.println(no + ". " + product.getId() + " " + product.getName() + " " + product.getCategory() + " " + product.getPrice());
                            no++;
                        }
                    }

                    // menunggu enter
                    scanner.nextLine();
                    System.out.print("Tekan Enter untuk kembali...");
                    scanner.nextLine();
                    break;
                }

                // menambah produk
                case 2 -> {
                    System.out.println("Tambah Produk Petshop Dudul Miaw-miaw");

                    // input data baru
                    System.out.print("Masukan ID: ");
                    int id = scanner.nextInt();
                    System.out.print("Masukan Nama: ");
                    String name = scanner.next();
                    System.out.print("Masukan Kategori: ");
                    String category = scanner.next();
                    System.out.print("Masukan Harga: ");
                    int price = scanner.nextInt();

                    // buat objek temp dengan parameter
                    Petshop temp = new Petshop(id, name, category, price);

                    // tambahkan ke arraylist
                    products.add(temp);

                    System.out.println("Produk ditambahkan");

                    // menunggu enter
                    scanner.nextLine();
                    System.out.print("Tekan Enter untuk kembali...");
                    scanner.nextLine();
                    break;

                }

                // edit produk
                case 3 -> {
                    System.out.println("Edit Produk Petshop Dudul Miaw-miaw");

                    // input id yang akan diubah
                    System.out.print("Masukan ID yang ingin diubah: ");
                    int id = scanner.nextInt();

                    // mencari produk
                    int i = 0;
                    int found = 0;
                    Petshop product = null; // untuk menyimpan objeknya
                    while (i < products.size() && found == 0) { 
                        product = products.get(i);

                        if (product.getId() == id) {
                            found = 1;
                        }else{
                            i++;
                        }
                    }

                    // jika tidak ada
                    if(found == 0){
                        System.out.println("Produk tidak ditemukan");
                    }else{
                        // jika ada input data selain id
                        System.out.print("Masukan Nama: ");
                        String name = scanner.next();
                        System.out.print("Masukan Kategori: ");
                        String category = scanner.next();
                        System.out.print("Masukan Harga: ");
                        int price = scanner.nextInt();

                        // update menggunakan setter
                        product.setName(name);
                        product.setCategory(category);
                        product.setPrice(price);

                        System.out.println("Produk diubah");
                    }

                    // menunggu enter
                    scanner.nextLine();
                    System.out.print("Tekan Enter untuk kembali...");
                    scanner.nextLine();
                    break;
                }
                // hapus produk
                case 4 -> {
                    System.out.println("Hapus Produk Petshop Dudul Miaw-miaw");

                    // input data
                    System.out.print("Masukan ID yang ingin diubah: ");
                    int id = scanner.nextInt();

                    // cari produk
                    int i = 0;
                    int found = 0;
                    Petshop product = null; // untuk menyimpan objek
                    while (i < products.size() && found == 0) { 
                        product = products.get(i);
                        
                        if (product.getId() == id) {
                            found = 1;
                        }else{
                            i++;
                        }
                    }

                    // jika tidak ada
                    if(found == 0){
                        System.out.println("Produk tidak ditemukan");
                    }else{
                        // jika ada hapus dari arraylist
                        products.remove(product);
                        
                        System.out.println("Produk dihapus");
                    }

                    // menunggu enter
                    scanner.nextLine();
                    System.out.print("Tekan Enter untuk kembali...");
                    scanner.nextLine();
                    break;
                }
                // cari produk dengan nama
                case 5 -> {
                    System.out.println("Cari Produk Petshop Dudul Miaw-miaw");

                    // input nama yang akan dicari
                    System.out.print("Masukan Nama Produk yang ingin dicari: ");
                    String name = scanner.next();

                    // cari dan langsung tampilkan jika sesuai
                    int no = 1;
                    int found = 0;
                    
                    for (Petshop product : products) {
                        if (product.getName().equals(name)) {
                            found = 1;
                            System.out.println(no + ". " + product.getId() + " " + product.getName() + " " + product.getCategory() + " " + product.getPrice());
                            no++;
                        }
                    }

                    if(found == 0){
                        System.out.println("Produk tidak ditemukan");
                    }else{
                        System.out.println("Produk ditemukan");
                    }

                    // menunggu enter
                    scanner.nextLine();
                    System.out.print("Tekan Enter untuk kembali...");
                    scanner.nextLine();
                    break;
                }
                // keluar menu
                case 6 -> {
                    end = 1;
                    System.out.println("Keluar...");
                    break;
                }
                // default
                default -> {
                    System.out.println("Menu tidak ada");
                    break;
                }
            }
    }

    // close scanner
    scanner.close();
    }
}
