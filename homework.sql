create database homework;
use homework;

drop table users;
CREATE TABLE users(
	id int primary key auto_increment,
    email varchar(30),
    password varchar(100)
);

drop table users_data;
CREATE TABLE users_data(
	id int,
    nome varchar(30),
    cognome varchar(30),
    numero_telefono varchar(12),
    indirizzo varchar(100),
    citta varchar(30),
    codice_postale varchar(5),
    foreign key(id) references users(id)
);

drop table shop_items;
CREATE TABLE Shop_Items (
	itemID int primary key auto_increment,
    brand varchar(50),
    nome varchar(100),
    categoria int,   /*1=accessories, 2=clothing 3=footwear  4=lifestyle */
    descrizione varchar(7000),
    colore VARCHAR(50),
    materiale VARCHAR(200),
    costo double
);


drop table shop_items_size;
CREATE TABLE Shop_Items_Size(
	itemID int,
    numXS int,
    numS int,
    numM int,
    numL int,
    numOneSize int,
    foreign key (itemID) references Shop_Items(itemID)
);



drop table shop_items_immages;
CREATE TABLE Shop_Items_Immages(
	itemID int,
    img1 VARCHAR(200),
    img2 VARCHAR(200),
    img3 VARCHAR(200),
    img4 VARCHAR(200),
    foreign key (itemID) references Shop_Items(itemID)
);

drop table saved;
CREATE TABLE Saved( /*IL COSTO TOTALE DEL CARRELLO LO FACCIO LATO JS*/
	userID int,
    itemID int,
    foreign key (userID) references users(id),
    foreign key (itemID) references Shop_Items(itemID),
    unique(userID, itemID)
);

/*BISOGNA FARE " TRIGGER:
1)AGGIUMGENDO/DIMINUENDO LE MISURE CHE SONO STATE AGGIUNGE AL CARRELLO NELLA TABELLA SHOP_ITEMS_SIZE

*/
drop table shopping_cart;
CREATE TABLE shopping_cart(
	userID int,
    itemID int,
    size_item varchar(10),
    foreign key (userID) references users(id),
    foreign key(itemID) references shop_items(itemID)
);

drop table orders;
CREATE TABLE orders(
	orderID INT PRIMARY KEY AUTO_INCREMENT,
    userID int,   
    nome varchar(30),
    cognome varchar(30),
    numero_telefono varchar(12),
    indirizzo varchar(100),
    citta varchar(30),
    codice_postale varchar(5),   
    shipping_type int,  /* 1=fedex standard, 2=dhl standard, 3= fedex priority*/
	order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (userID) references users(id)    
);

drop table order_items;
create table order_items(	
    orderID INT NOT NULL,
    itemID INT NOT NULL,
    size_item VARCHAR(10),
    primary key (orderID, itemID),
    FOREIGN KEY (orderID) REFERENCES orders(orderID),
    foreign key (itemID) references shop_items(itemID)
);




/*   bisogna modificare questi trigger in modo tale da aggiornare la tabella quando gli item vengono effettivamente acquistati (cioè quando vengono
aggiunti allla tabella degli ordini*/
drop trigger UpdateSizeTableInsert;
delimiter //
create trigger UpdateSizeTableInsert
after insert on order_items
for each row
begin	
    if( new.size_item = 'XS') 
    then update shop_items_size
    set numXS=numXS-1
    where itemID = new.itemID;
    end if;
    
    if( new.size_item = 'S') 
    then update shop_items_size
    set numS=numS-1
    where itemID = new.itemID;
    end if;
    
    if( new.size_item = 'M') 
    then update shop_items_size
    set numM=numM-1
    where itemID = new.itemID;
    end if;
    
    if( new.size_item = 'L') 
    then update shop_items_size
    set numL=numL-1
    where itemID = new.itemID;
    end if;
    
    if(new.size_item='One Size')
    then update shop_items_size
    set numOneSize=numOneSize-1
    where itemID = new.itemID;
    end if; 
    
end //
delimiter ; 


drop trigger UpdateSizeTableRemove;
delimiter //
create trigger UpdateSizeTableRemove
after delete on order_items
for each row
begin	
    if( old.size_item = 'XS') 
    then update shop_items_size
    set numXS=numXS+1
    where itemID = old.itemID;
    end if;
    
    if( old.size_item = 'S') 
    then update shop_items_size
    set numS=numS+1
    where itemID = old.itemID;
    end if;
    
    if( old.size_item = 'M') 
    then update shop_items_size
    set numM=numM+1
    where itemID = old.itemID;
    end if;
    
    if( old.size_item = 'L') 
    then update shop_items_size
    set numL=numL+1
    where itemID = old.itemID;
    end if;    
    
    if(old.size_item='One Size')
    then update shop_items_size
    set numOneSize=numOneSize+1
    where itemID = old.itemID;
    end if; 
end //
delimiter ; 





/*1*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Porter-Yoshida & Co.', 'Tanker Shoulder Bag Black', '1', 'Porter’s Tanker Shoulder Bag 
is designed to be your everyday bag. Crafted from a durable nylon fabric, the staple style is slightly
padded and features pockets on both the interior and exterior for optimal organization. The bag’s shoulder strap is 
both adjustable and removable, making way for multiple carrying options.', 'Black', 'Three-layer fabric with a nylon twill front,
 polyester cotton middle, and nylon taffeta back', 430.00);
INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (1, 0,0,0,0,4);

 
 INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(1,'immagini/shop-page-img/accessories/item1-front.avif', 'immagini/shop-page-img/accessories/item1-back.avif',
		'immagini/shop-page-img/accessories/item1-worn.avif', 'immagini/shop-page-img/accessories/item1-details.avif');
        

/*2*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Porter-Yoshida & Co.', 'Tanker Daypack Black', '1', 'The Daypack comes from Porter\'s Tanker series, which dates back to the 1980s 	and is notable
 for featuring layered fabric used by the US Air Force for flight jackets. Noticeably lightweight with a soft, yet durable nylon twill finish, the backpack is 
 completed with a laptop pouch, internal and external pockets, and gold-tone hardware.', 'Black',
 'Tear-stopping nylon ripstop fabric', 740.00);
 
 
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(2,'immagini/shop-page-img/accessories/item2-front.avif', 'immagini/shop-page-img/accessories/item2-back.avif',
		'immagini/shop-page-img/accessories/item2-worn.avif', 'immagini/shop-page-img/accessories/item2-details.avif');
        
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (2, 0,0,0,0,6);
        

/*3*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Porter-Yoshida & Co.', 'Force Shoulder Bag Olive Drab', '1', 'A part of the brand\'s Force collection, the Shoulder 
Bag draws from military styles. It is predominantly constructed using nylon and has an acrylic coating as well as a quilted interior. 
An adjustable shoulder strap allows you to dial in the 	fit of the bag, while a main zippered compartment and two external zippered pockets
	provide you with ample space for storing daily essentials.', 'olive Drab', '100% nylon', 260.00);
	
    
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(3,'immagini/shop-page-img/accessories/item3-front.avif', 'immagini/shop-page-img/accessories/item3-back.avif',
		'immagini/shop-page-img/accessories/item3-worn.avif', 'immagini/shop-page-img/accessories/item3-details.avif');
        
INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (3, 0,0,0,0,2);

/*4*/        
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Porter-Yoshida & Co.', 'Tanker Backpack Sage Green', '1', 'The Tanker Backpack is a staple Porter style constructed 
using an original three-layer fabric developed for US Air Force flight jackets. The material, which consists of nylon twill,
 polyester cotton, and nylon taffeta, is noticeably light and soft, all while being highly durable. The Tanker is outfitted 
 with asymmetrical pockets on the front and metal fittings for longevity.', 'Sage Green', '100% nylon', 585.00);

 INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(4,'immagini/shop-page-img/accessories/item4-front.avif', 'immagini/shop-page-img/accessories/item4-back.avif',
		'immagini/shop-page-img/accessories/item4-worn.avif', 'immagini/shop-page-img/accessories/item4-details.avif');
        
INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (4, 0,0,0,0,0);
        
        
/* 5*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('G-Shock', 'GD-400GB-1ER', '1', 'The GD400 is one of G-Shock’s toughest watches due to its large case and bulbar (wire-face protector). First released in 2014, the model has been updated with new colorways and has all the features and add-ons Casio’s timepieces are known for. G-Shock has outfitted the GD400 with a background illuminator and neo-display for visibility in low-light situations, a timer and stop function for athletes, a multifunctional alarm, a world time function with up to 4 different time zones, and an automatic calendar, among other features.
', 'Black', 'Carbon-reinforced resin case, mineral glass and additional bullbar for superior protection.', 75.00);
 
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(5,'immagini/shop-page-img/accessories/item5-front.avif', 'immagini/shop-page-img/accessories/item5-back.avif',
		'immagini/shop-page-img/accessories/item5-box.avif', 'immagini/shop-page-img/accessories/item5-details.avif');
        
INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (5, 0,0,0,0,10);
/*6*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('G-Shock', 'GM-5600U-1ER The Origin Silver/Black', '1', 'The first G-Shock design change came by way of the 5600 in 1987. The model is now encased in shockproof housing for durability and flexibility, as the resin case makes it ideal for everyday wear, and scratch-resistant mineral glass offers added protection from unsightly damage. Also known for its technical specifications, G-Shock has outfitted the 5600 with a background illuminator for visibility in low-light situations, timer and stop function for athletes, multifunctional alarm, and automatic calendar, among other features.
', 'Black', 'Resin case, mineral glass, led display', 180.00);

INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(6,'immagini/shop-page-img/accessories/item6-front.avif', 'immagini/shop-page-img/accessories/item6-back.avif',
		'immagini/shop-page-img/accessories/item6-box.avif', 'immagini/shop-page-img/accessories/item6-details.avif');
        
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (6, 0,0,0,0,4);
        
/*7*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Marni x retrosuperfuture', 'Ik Kil Cenote Panna', '1', 'Marni eyewear is produced in partnership with contemporary sunglasses brand, Retrosuperfuture. Models like the Ik Kil Cenote are unconventional and eye-catching, characterized by oversized silhouettes and chunky shapes in bold colors. Expertly crafted in Italy, these glasses combine a chunky oval acetate frame with orange-tinted lenses, featuring sturdy temples accented with gold-tone metal and Marni branding.
', 'Panna', '60% acetate, 40% nylon', 270.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(7,'immagini/shop-page-img/accessories/item7-front.avif', 'immagini/shop-page-img/accessories/item7-back.avif',
		'immagini/shop-page-img/accessories/item7-box.avif', 'immagini/shop-page-img/accessories/item7-details.avif');
        
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (7, 0,0,0,0,0);
        
/*8*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Marni x retrosuperfuture', 'IMavericks Radica', '1', 'Marni eyewear is produced in partnership with contemporary sunglasses brand, Retrosuperfuture. Models like the Mavericks are unconventional and eye-catching, characterized by oversized silhouettes and chunky shapes in bold colors. Expertly crafted in Italy, these glasses combine a low-riding, wooden-textured acetate frame with tinted lenses, featuring sturdy temples accented with gold-tone metal and Marni branding.
', 'Radica', '60% acetate, 40% nylon', 320.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(8,'immagini/shop-page-img/accessories/item8-front.avif', 'immagini/shop-page-img/accessories/item8-back.avif',
		'immagini/shop-page-img/accessories/item8-box.avif', 'immagini/shop-page-img/accessories/item8-details.avif');
        
INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (8, 0,0,0,0,1);
        
        /* 9 comiciano i clothing*/
        
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('C.P. Company', 'PiUM Hooded Jacket Ivy Green', '2', 'This Hooded Jacket from C.P. Company is made using PiUM, a single strate opaque transparent RFD polyurethane membrane that retails little pigment, leading to the slightly pastel tones of the finished piece. The garment features an adjustable drawstring hood and button cuffs for minor alterations, with full-zip fastening at the front. Pockets are incorporated onto the front of the garment as well as the sleeve, where you will find the brand\'s signature lens detail.
', 'Ivy Green', '100% polyurethane', 795.00);

INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(9,'immagini/shop-page-img/clothing/item1-front.avif', 'immagini/shop-page-img/clothing/item1-side.avif',
		'immagini/shop-page-img/clothing/item1-details.avif', 'immagini/shop-page-img/clothing/item1-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (9, 4,5,0,8,0);


/*10*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Adidas x Wales Bonner', 'Short-Sleeve Tee Bold Orange/Team Royal Blue', '2', 'A nod to classic sportswear, this adidas x Wales Bonner Tee embodies a throwback feel. It is crafted from pure organic cotton and detailed with iconography from both brands. You will find adidas\' signature Three Stripes running down the sleeves, while the equally recognizable Trefoil logo is showcased at the chest. Opposite the Trefoil insignia is a matching Wales Bonner logo on the right side of the chest.
', 'Bold Orange/Team Royal Blue', '100% organic cotton', 100.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(10,'immagini/shop-page-img/clothing/item2-front.avif', 'immagini/shop-page-img/clothing/item2-side.avif',
		'immagini/shop-page-img/clothing/item2-details.avif', 'immagini/shop-page-img/clothing/item2-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (10, 0,0,10,8,0);

/*11*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Jil Sander', 'Zip-Up Jacket Eggshell', '2', 'The Zip-Up Jacket is a cozy Jil Sander style predominantly crafted from natural cotton fleece. It is lined with a viscose-elastane blend and outfitted with a standing collar as well as full front zip fastening detailed with a logo puller. Zippered pockets are incorporated onto the front of the garment to complete the design.
', 'Eggshell', ' Outer is 100% natural cotton fleece, Lining is 95% viscose, 5% elastane', 990.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(11,'immagini/shop-page-img/clothing/item3-front.avif', 'immagini/shop-page-img/clothing/item3-side.avif',
		'immagini/shop-page-img/clothing/item3-details.avif', 'immagini/shop-page-img/clothing/item3-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (11, 3,0,0,8,0);
        
/*12*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Museum of Peace & Quiet', 'Mano Curativa T-Shirt Forest', '2', 'The Mano Curativa is a seasonal graphic style from Museum of Peace & Quiet. Cut from 100% cotton for a versatile unisex fit, the short-sleeve shirt features a traditional rib knit crew neck and a straight hem. A custom graphic print is showcased on the front of the tee to ultimately define the style.
', 'Forest ', '100% cotton', 65.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(12,'immagini/shop-page-img/clothing/item4-front.avif', 'immagini/shop-page-img/clothing/item4-side.avif',
		'immagini/shop-page-img/clothing/item4-details.avif', 'immagini/shop-page-img/clothing/item4-details2.avif');
        
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (12, 4,0,10,0,0);


/*13*/

INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('KUSIKOHC', 'KSK R Patch Denim Pants Black', '2', 'This pair of Kusikohc denim is defined by contrasting detailing in an intricate pattern at the legs. The style is cut for a straight leg fit from 100% cotton and features traditional five-pocket styling. Other details include button fastening, a concealed fly, and belt loops lining the waist. The pant is then finished with a leather logo patch applied to the back of the waistband.
', 'Black', '100% cotton', 840.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(13,'immagini/shop-page-img/clothing/item5-front.avif', 'immagini/shop-page-img/clothing/item5-side.avif',
		'immagini/shop-page-img/clothing/item5-details.avif', 'immagini/shop-page-img/clothing/item5-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (13, 0,0,10,8,0);


/*14*/

INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Story mfg.', 'Uniform Shirt Diamond Check', '2', 'The Uniform Shirt is a lightweight organic cotton style cut for a classic boxy fit. It is defined by a diamond check pattern implemented throughout, one that is complemented by striped detailing. The short-sleeve button-down features a point collar and a straight hem, with a single chest pocket that incorporates an intricate Story mfg. embroidered logo.
', 'Diamond Check', '100% organic cotton', 325.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(14,'immagini/shop-page-img/clothing/item6-front.avif', 'immagini/shop-page-img/clothing/item6-side.avif',
		'immagini/shop-page-img/clothing/item6-details.avif', 'immagini/shop-page-img/clothing/item6-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (14, 8,9,10,0,0);

/*15*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Nike x Patta', 'Running Team Varsity Jacket Black/Yellow/White', '2', 'The Running Team Varsity Jacket arrives as part of Nike and Patta\'s latest collection and is crafted with pebbled leather sleeves in a sturdy, heavyweight design. Made with a wool body, the jacket includes a polyester lining and features side and interior pockets to keep your goodies secure. Embellished with an array of co-branded chenille patches throughout for that traditional letterman look, the collaborative jacket is finished with a button closure and striped ribbing at the hem, collar, and cuffs.
', 'Black', '55% wool, 35% polyester, 10% rayon', 600.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(15,'immagini/shop-page-img/clothing/item7-front.avif', 'immagini/shop-page-img/clothing/item7-side.avif',
		'immagini/shop-page-img/clothing/item7-details.avif', 'immagini/shop-page-img/clothing/item7-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (15, 0,0,0,0,0);
   

/*16*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Awake NY', 'Painter Pant Blue', '2', 'The Painter Pant is Awake NY\'s take on a classic workwear style. Constructed from 100% cotton, the pair has been subjected to a dyed treatment that creates a more distinctive look. Traditional design elements are incorporated including tool pockets and a hammer loop, as the pair is finished with a stitched "A" logo as well as a brand patch attached to the back right pocket.
', 'Blue', '100% cotton', 170.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(16,'immagini/shop-page-img/clothing/item8-front.avif', 'immagini/shop-page-img/clothing/item8-side.avif',
		'immagini/shop-page-img/clothing/item8-details.avif', 'immagini/shop-page-img/clothing/item8-details2.avif');
	INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (16, 8,0,10,0,0);


/*17 inizio footwear*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('New Balance', '1906 REH Harbor Gray', '3', 'New Balance has rejuvenated the 1906R in a major way. Named for the year the brand was founded, the familiar silhouette is updated with an upper inspired by running shoe designs from the 2000s. Now with considerably more lifestyle appeal, the 1906R is still a staple in the running world, boasting a timeless look and refined upgrades. ACTEVA LITE in the midsole and ABZORB SBS cushioning in the heel ensure comfort and stability, while a N-ergy shock absorbing outsole with a Stability Web adds arch support, creating a shoe that performs just as good as it looks.
', 'Harbor Grey', 'Leather, textile, and mesh upper. Reflective N logo', 160.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(17,'immagini/shop-page-img/footwear/item1-front.avif', 'immagini/shop-page-img/footwear/item1-back.avif',
		'immagini/shop-page-img/footwear/item1-side1.avif', 'immagini/shop-page-img/footwear/item1-side2.avif');
INSERT INTO shop_items_size (itemid, numXS, numS, numM, numL, numOneSize) values (17, 7,2,4,0,0);
        
        
/*18*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Adidas x Wales Bonner', 'Samba Desert/White', '3', 'The Samba is an undisputed adidas icon. Born on the soccer (football) field, the sleek, low-top silhouette is a timeless style with certified street appeal. A part of the latest Wales Bonner collaboration, this particular iteration draws from the enduring legacy of East African runners. It arrives in two colorways, each featuring a soft leather upper with complementary overlays and trademark Three Stripes detailing on the side. Below, you will find a textured gum rubber cupsole, as additional iconography is incorporated throughout the shoe, including the Wales Bonner logo and co-branding on the tongue and insole.
', 'R Desert W Wht', 'Leather upper, suede overlays, textile lining, rubber sole', 180.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(18,'immagini/shop-page-img/footwear/item2-front.avif', 'immagini/shop-page-img/footwear/item2-back.avif',
		'immagini/shop-page-img/footwear/item2-side1.avif', 'immagini/shop-page-img/footwear/item2-side2.avif');
        

/*19*/

INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Saucony x Minted', 'ProGrid Triumph 4 Cream/Green', '3', 'Saucony has reintroduced the ProGrid Triumph 4 in a major way, as the 2000s runner is back with the same key details as when it first launched years ago. Catering to those who appreciate both style and technology, the resurgent sneaker fuses performance with lifestyle functionality, featuring an open mesh base with premium leather overlays and a medial panel packed with Arch-lock technology. ProGrid tooling is used in the midsole to ensure a comfy ride each time you step out.',
 'Cream/Green', 'Upper is 49% textile, 41% synthetic, 10% leather. Insole is 100% textile, lining is 100% textile & outsole is 100% rubber', 180.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(19,'immagini/shop-page-img/footwear/item3-front.avif', 'immagini/shop-page-img/footwear/item3-back.avif',
		'immagini/shop-page-img/footwear/item3-side1.avif', 'immagini/shop-page-img/footwear/item3-side2.avif');
        

/*20*/

INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Nike x Patta', 'Air Huarache 20Y24 Saffron Quartz/Cool Grey-Sanddrift', '3', 'Nike and Patta reunite for a new running-themed collection with the footwear and varsity jacket being the stars of the drop. The new Air Huarache 20Y24 blends the upper from the Nike Huarache Plus with the Nike Pegasus sole, for a shoe detailed with premium leather overlays and mesh underlay featuring a bootie construction. The upper is secured with a nylon webbing closure and the silhouette is finished with co-branded logos at the heel pull and tongue patch.',
 'Saffron Quartz/Cool Grey-Sanddrift', 'Mesh upper with leather overlays, rubber outsole, adjustable nylon webbing closure', 160.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(20,'immagini/shop-page-img/footwear/item4-front.avif', 'immagini/shop-page-img/footwear/item4-back.avif',
		'immagini/shop-page-img/footwear/item4-side1.avif', 'immagini/shop-page-img/footwear/item4-side2.avif');
        
/*21*/
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Reebok', 'Premier Road Modern Dream Pink', '3', 'Inspired by the brand\'s 2005 running collection, the Premier Road Modern is primed and ready to bring some post-Y2K flavor to your wardrobe. This new iteration is updated with modern material executions, emerging in a tonal pink colorway for adding a splash of color to your outfits. The shoe is outfitted with soft DMX foam in the midsole that enhances comfort each step of the way, in addition to reinforcement in the midfoot area that offers light support and stability. Reebok’s iconic Vector logo is incorporated on each side of the silhouette to boldly brand the monochrome sneaker.',
 'Pink', 'Upper is 22% polyester, 78% polyurethane; lining is 100% polyester; sole is 10% thermoplastic polyurethane, 40% rubber, 50% EVA
', 220.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(21,'immagini/shop-page-img/footwear/item5-front.avif', 'immagini/shop-page-img/footwear/item5-back.avif',
		'immagini/shop-page-img/footwear/item5-side1.avif', 'immagini/shop-page-img/footwear/item5-side2.avif');
    
/*22*/

INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Reebok x Botter', 'Energia Bo Kèts White/Beige', '3', 'BOTTER is back alongside Reebok to once again reimagine the Energia Bo Kèts. This time around, the sleek silhouette emerges in a clean white colorway and a stealthy black look, featuring a synthetic upper and a rubber sole. The sneaker, which draws from Reebok\'s archival soccer cleats from the 2000s as well as their 90s climbing shoes, is defined by its fold-over tongue, here branded with the iconic Vector logo. The symbol also appears on other areas of the shoe, complemented by BOTTER iconography that signals the collaboration.',
 'White Beige', 'Upper is 60% polyurethane, 40% polyester; lining is 100% polyester; sole is 50% EVA, 40% rubber, 10% thermoplastic polyurethane', 330.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(22,'immagini/shop-page-img/footwear/item6-front.avif', 'immagini/shop-page-img/footwear/item6-back.avif',
		'immagini/shop-page-img/footwear/item6-side1.avif', 'immagini/shop-page-img/footwear/item6-side2.avif');
  
  
/*23*/


INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Acne Studios', 'Low-Top Sneakers Grey Blue', '3', 'Drawing from 1980s basketball sneakers, this Acne Studios footwear style is predominantly crafted from leather, with a metallic finish and cracked suede inserts. The low-top model is lined in polyester and finished with a flat sole with logo detailing. Additional iconography emerges at the footbed and heel of the lace-up sneaker.',
 'Grey Blue', 'Upper is 100% cow leather, lining is 100% polyester, sole is 100% thermoplastic polyurethane', 450.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(23,'immagini/shop-page-img/footwear/item7-front.avif', 'immagini/shop-page-img/footwear/item7-back.avif',
		'immagini/shop-page-img/footwear/item7-side1.avif', 'immagini/shop-page-img/footwear/item7-side2.avif');
  
  /*24*/
  
INSERT INTO shop_items (brand, nome, categoria, descrizione, colore, materiale, costo) 
VALUES('Acne Studios', 'Leather Loafers Beige', '3', 'This luxe new version of the Acne Studios Loafer is executed in a snake-finish print leather with leather soles. Also lined in leather, the shoe is then finished with metal debossed animation on the front.',
 'Beige', 'Upper is 100% calf leather, lining is 100% lamb leather, sole is 100% calf leather; snake print', 690.00);
INSERT INTO shop_items_immages(itemID, img1, img2, img3, img4) 
 VALUES(24,'immagini/shop-page-img/footwear/item8-front.avif', 'immagini/shop-page-img/footwear/item8-back.avif',
		'immagini/shop-page-img/footwear/item8-side1.avif', 'immagini/shop-page-img/footwear/item8-side2.avif');
  
  








 
