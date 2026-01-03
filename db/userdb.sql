CREATE DATABASE userdb;

CREATE TABLE users(
	id INT AUTO_INCREMENT,
    username VARCHAR(255),
    email VARCHAR(255),
    pwd VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    size ENUM('XS','S','M','L','XL') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (product_name, size, price, stock) VALUES
('Product name', 'Product Size', 50, 100);

INSERT INTO products (id, product_name, size, price, stock) VALUES
(1,  'Shorts',      'M', 199.00, 120),
(8,  'Hoodie',      'L', 399.00, 150),
(9,  'Socks',       'S',  49.00, 300),
(10, 'Shoes',       'L', 499.00, 110),
(11, 'Shirt',       'M', 249.00, 140),
(12, 'Sweatshirt',  'L', 399.00, 130),
(19, 'Bracelet',    'S',  59.00, 250),
(20, 'Glasses',     'M',  79.00, 180);


INSERT INTO products (id, product_name, size, price, stock) VALUES
(13, 'Shirt',       'M', 229.00, 140),
(14, 'Socks',       'S',  49.00, 300),
(15, 'Sandals',     'M', 399.00, 120),
(16, 'Dress',       'M', 349.00, 130),
(17, 'Hairband',    'S',  39.00, 280),
(18, 'Necklace',    'S',  59.00, 200),
(21, 'Bracelet',    'S',  49.00, 260),
(22, 'Glasses',     'M',  79.00, 180);

INSERT INTO products (id, product_name, size, price, stock) VALUES
(2,  'Shirt',       'XS', 149.00, 150),
(3,  'Pants',       'XS', 159.00, 140),
(4,  'Jacket',      'S',  199.00, 120),
(5,  'Hat',         'XS',  49.00, 200),
(6,  'Mittens',     'XS',  29.00, 220),
(7,  'Blanket',     'M',  199.00, 130),
(23, 'Socks',       'XS',  39.00, 270),
(24, 'Sweatshirt',  'S',  179.00, 160);


INSERT INTO products (id, product_name, size, price, stock) VALUES
(25, 'Shirt',       'S', 199.00, 150),
(26, 'Shorts',      'S', 179.00, 140),
(27, 'Dress',       'S', 249.00, 130),
(28, 'Sandals',     'M', 299.00, 120),
(29, 'Jacket',      'M', 299.00, 110),
(30, 'Socks',       'XS', 39.00, 260),
(31, 'Hat',         'XS', 59.00, 200),
(32, 'Pajamas',     'M', 199.00, 150);
