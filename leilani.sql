drop database Leilani;

create database Leilani;



-- Database: `Leilani`

-- Table structure for table `Customer`

create table `customer`(
    `customer_ID` int not null primary key auto_increment,
    `fname` varchar (20) NOT NULL,
    `lname` varchar (20) NOT NULL,
    `contact` varchar(20) NOT NULL,
    `email` varchar(30) NOT NULL,
    `password` varchar(30) NOT NULL
);

--Table structure for table `Category`
create table `category`(
    `category_ID` int not null primary key auto_increment,
    `category_name` varchar(30) NOT NULL,
    `ctg_descrpt` varchar(30) NOT NULL,
    `image_url` varchar(300)

);


-- Table structure for table `Products`

create table `products`(
    `product_ID` int not null primary key auto_increment,
    `product_name` varchar(50) NOT NULL,
    `description` varchar(50) NOT NULL,
    `size` varchar(50) NOT NULL,
    `colour`varchar(50) NOT NULL,
    `unit_price` int (11) NOT NULL,
    `image_url` varchar(300),
    `availability` varchar(50) NOT NULL
);

-- Table structure for table `Cart`
Create table `cart` (
  `cart_ID` int not null primary key auto_increment,
  `product_ID` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  foreign key (`product_ID`) references product
    
);

-- Table structure for table `Payment`

create table `payment` (
    `payment_id`int not null primary key auto_increment,
    `payment_type` varchar(50) NOT NULL
);


-- Table structure for table `Order`

create table `order`(
    `order_ID`int not null primary key auto_increment,
    `customer_ID` int,
    `payment_ID` int,
    `order_date` date,
    `ship_date` date,
    `arrival_date` date,
    foreign key (`customer_ID`) references customer,
    foreign key (`payment_ID`) references payment
);


-- Table structure for table `Order details`
create table `order_details`(
    `order_ID`int,
    `product_ID` int,
    `order_detailsID` int not null primary key auto_increment,
    `quantity` varchar(50) NOT NULL,
    `price` decimal(4,2),
    `colour` varchar(50) NOT NULL,
    foreign key (`order_ID`) references order,
    foreign key (`product_ID`) references products
    --`total` sum(`quantity`),--

);





