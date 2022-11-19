import pymysql


class MYSQLither:

    def __init__(self):
        self.conn = pymysql.connect(host='localhost',
                                    user='root',
                                    password='',
                                    database='flower_shop')
        self.c = self.conn.cursor()

    def create_tables(self):
        self.c.execute("""CREATE TABLE IF NOT EXISTS client
              (id INTEGER PRIMARY KEY AUTO_INCREMENT, first_name TEXT, last_name TEXT, email TEXT, password TEXT)""")

        self.c.execute("""CREATE TABLE IF NOT EXISTS categories
                (id INTEGER PRIMARY KEY AUTO_INCREMENT, category_name TEXT)""")
        self.c.execute("""CREATE TABLE IF NOT EXISTS products
                (id INTEGER PRIMARY KEY AUTO_INCREMENT, name TEXT, amount INTEGER, category_id INTEGER, preview_image TEXT, description TEXT, count INTEGER)""")

        self.c.execute("""CREATE TABLE IF NOT EXISTS purchases
                  (id INTEGER PRIMARY KEY AUTO_INCREMENT, client_id INTEGER, product_id INTEGER, adress TEXT, purchase_amount INTEGER, status INTEGER)""")

    def get_category_by_name(self, category_name):
        self.c.execute("SELECT * FROM `categories` WHERE `category_name`=%s", (category_name,))
        return self.c.fetchone()

    def exists_category(self, category_name):
        self.c.execute("SELECT * FROM `categories` WHERE `category_name`=%s", (category_name,))
        return bool(self.c.fetchone())

    def add_category(self, category_name):
        self.c.execute("INSERT INTO `categories` (`category_name`) VALUES(%s)", (category_name,))
        return self.c.lastrowid

    def exists_product(self, name, category_id, description, preview_image):
        self.c.execute("SELECT * FROM `products` WHERE `name`=%s && `category_id`=%s && `description`=%s && `preview_image`=%s", (name, category_id, description,preview_image,))
        return bool(self.c.fetchone())

    def add_product(self, name, amount, category_id, preview_image, description, count):
        self.c.execute(
            "INSERT INTO `products` (`name`, `amount`, `category_id`, `preview_image`, `description`, `count`) VALUES(%s,%s,%s,%s,%s,%s)",
            (name, amount, category_id, preview_image, description, count,))
