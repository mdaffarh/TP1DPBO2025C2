class Petshop:
    # konstruktor
    def __init__(self, id, name, category, price):
        self.id = id
        self.name = name
        self.category = category
        self.price = price
        
    # getter dan setter untuk id
    def setId(self, id):
        self.id = id
    
    def getId(self):
        return self.id
    
    # getter dan setter untuk name
    def setName(self, name):
        self.name = name
    
    def getName(self):
        return self.name
    
    # getter dan setter untuk category
    def setCategory(self, category):
        self.category = category
    
    def getCategory(self):
        return self.category
    
    # getter dan setter untuk price
    def setPrice(self, price):
        self.price = price
    
    def getPrice(self):
        return self.price