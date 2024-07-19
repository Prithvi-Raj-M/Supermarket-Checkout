from django.db import models
import hashlib
import random
import string

class ProductDB(models.Model):
    id=models.AutoField(primary_key=True)
    name=models.CharField(max_length=100)
    price=models.CharField(max_length=100)
    quantity=models.CharField(max_length=10,default=None)
    category=models.CharField(max_length=10,default=None)
    code=models.CharField(max_length=100)

    
    def __str__(self):
        return self.name

class User(models.Model):
    uid = models.AutoField(primary_key=True) 
    name = models.CharField(max_length=100)
    email = models.EmailField(unique=True)  
    password = models.CharField(max_length=128)  
    email_verified = models.BooleanField(default=False)  #
    additional_params = models.TextField(blank=True, null=True) 

    def __str__(self):
        return self.name
    
class Admin(models.Model):
    uid = models.AutoField(primary_key=True) 
    name = models.CharField(max_length=100)
    email = models.EmailField(unique=True)  
    password = models.CharField(max_length=128)  

    def __str__(self):
        return self.name

class Verify_Email(models.Model):
    uid = models.AutoField(primary_key=True)
    email = models.CharField(max_length=100)
    hash = models.CharField(max_length=100)

    def generate_unique_hash(self):
        random_string = ''.join(random.choices(string.ascii_letters + string.digits, k=16))
        unique_hash = hashlib.sha256((self.email + random_string).encode()).hexdigest()
        self.hash = unique_hash
        self.save()

    def __str__(self):
        return self.email
    
class Cart(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)

    def __str__(self):
        return f"Cart for {self.user.username}"

    def add_item(self, item_name, quantity,price):
        existing_item = self.cartitem_set.filter(item=item_name).first()

        if existing_item:
            existing_item.quantity += quantity
            existing_item.price += price 
            existing_item.save()
        else:
            CartItem.objects.create(cart=self, item=item_name, quantity=quantity, price=price)

    def remove_item(self, item_name):
        self.cartitem_set.filter(item=item_name).delete()

    def get_quantity(self, item_name):
        item = self.cartitem_set.filter(item=item_name).first()
        return item.quantity if item else 0



class CartItem(models.Model):
    cart = models.ForeignKey(Cart, on_delete=models.CASCADE)
    item = models.CharField(max_length=100)
    quantity = models.IntegerField(default=1)
    price = models.IntegerField(default=0)

    def __str__(self):
        return f"{self.quantity} x {self.item} in cart for {self.cart.user.username}"
