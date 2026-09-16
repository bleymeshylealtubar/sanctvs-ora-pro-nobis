/* Table for users */
CREATE TABLE users (
    _id_ INT PRIMARY KEY AUTO_INCREMENT,
    _username_ VARCHAR(255) NOT NULL,
    _email_ VARCHAR(255) NOT NULL,
    _password_ VARCHAR(255) NOT NULL,
    _role_ ENUM('Customer','Admin') DEFAULT 'Customer' NOT NULL,
    _registered_ DATETIME NOT NULL,
    _theme_ ENUM('Gold Key','Silver Key') DEFAULT 'Gold Key' NOT NULL
);

/* Table for products */
CREATE TABLE products (
    _id_ INT PRIMARY KEY AUTO_INCREMENT,
    _product_name_ VARCHAR(255) NOT NULL,
    _title_ VARCHAR(255) NOT NULL,
    _price_ DECIMAL(5,2) NOT NULL,
    _product_class_ ENUM('Statues','Portraits','Accessories') NOT NULL,
    _style_ ENUM('Western','Eastern','Plain','Painted') DEFAULT 'Western' NOT NULL,
    _type_ ENUM('Crucifixes','Rosaries','Scapulars','Novenas') DEFAULT 'Crucifixes' NOT NULL,
    _person_ ENUM('Jesus Christ','Virgin Mary','St. Joseph','Saint','Blessed') DEFAULT 'Jesus Christ' NOT NULL,
    _uploaded_ DATETIME NOT NULL,
    _image_path_ VARCHAR(255) NOT NULL,
    _available_ ENUM('Yes','No') DEFAULT 'Yes',
    _stock_ INT NOT NULL
);

/* Table for orders */
CREATE TABLE orders (
    _id_ INT PRIMARY KEY AUTO_INCREMENT,
    _product_id_ INT NOT NULL,
    _product_name_ VARCHAR(255) NOT NULL,
    _price_ DECIMAL(5,2) NOT NULL,
    _quantity_ INT NOT NULL,
    _shipping_ DECIMAL(5,2) NOT NULL,
    _total_cost_ INT GENERATED ALWAYS AS ((_price_ * _quantity_) + _shipping_) STORED;
    _username_ VARCHAR(255) NOT NULL,
    _email_ VARCHAR(255) NOT NULL,
    _complete_address_ VARCHAR(255) NOT NULL,
    _payment_method_ ENUM('Cash-on-Delivery','GCash') DEFAULT 'Cash-on-Delivery' NOT NULL,
    _ordered_ VARCHAR(255) NOT NULL,
    _delivery_date_ VARCHAR(255) NOT NULL,
    _status_ ENUM('Ordered','Delivered','Cancelled') DEFAULT 'Ordered' NOT NULL,
    FOREIGN KEY fk_ord_id(_product_id_) REFERENCES products(_id_) ON UPDATE CASCADE,
    FOREIGN KEY fk_ord_nm(_product_name_) REFERENCES products(_product_name_) ON UPDATE CASCADE,
    FOREIGN KEY fk_ord_pr(_price_) REFERENCES products(_price_) ON UPDATE CASCADE,
    FOREIGN KEY fk_ord_us(_username_) REFERENCES products(_username_) ON UPDATE CASCADE,
    FOREIGN KEY fk_ord_em(_price_) REFERENCES products(_email_) ON UPDATE CASCADE
);

/* Table for saints */
CREATE TABLE saints(
    _id_ INT PRIMARY KEY AUTO_INCREMENT,
    _product_id_ INT NOT NULL,
    _saint_name_ VARCHAR(255) NOT NULL,
    _years_ VARCHAR(100) NOT NULL,
    _feast_day_ VARCHAR(255) NOT NULL,
    _beatified_ VARCHAR(255) NOT NULL,
    _canonized VARCHAR(255) NOT NULL,
    _patronage VARCHAR(255) NOT NULL,
    _veneration_site_ VARCHAR(255) NOT NULL,
    _life_ VARCHAR(255) NOT NULL,
    FOREIGN KEY fk_st_id(_product_id_) REFERENCES products(_id_) ON UPDATE CASCADE,
    FOREIGN KEY fk_st_nm(_saint_name_) REFERENCES products(_product_name_) ON UPDATE CASCADE
);

/* Table for blesseds */
CREATE TABLE blesseds(
    _id_ INT PRIMARY KEY AUTO_INCREMENT,
    _product_id_ INT NOT NULL,
    _blessed_name_ VARCHAR(255) NOT NULL,
    _years_ VARCHAR(100) NOT NULL,
    _feast_day_ VARCHAR(255) NOT NULL,
    _beatified_ VARCHAR(255) NOT NULL,
    _patronage VARCHAR(255) NOT NULL,
    _veneration_site_ VARCHAR(255) NOT NULL,
    _life_ VARCHAR(255) NOT NULL,
    FOREIGN KEY fk_bl_id(_product_id_) REFERENCES products(_id_) ON UPDATE CASCADE,
    FOREIGN KEY fk_bl_nm(_blessed_name_) REFERENCES products(_product_name_) ON UPDATE CASCADE
);

/* Table for accessories */
CREATE TABLE accessories(
    _id_ INT PRIMARY KEY AUTO_INCREMENT,
    _product_id_ INT NOT NULL,
    _product_name_ VARCHAR(255) NOT NULL,
    _symbolism_ VARCHAR(255) NOT NULL
    FOREIGN KEY fk_acc_id(_product_id_) REFERENCES products(_id_) ON UPDATE CASCADE,
    FOREIGN KEY fk_acc_nm(_product_name_) REFERENCES products(_product_name_) ON UPDATE CASCADE
);