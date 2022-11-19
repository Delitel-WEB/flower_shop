from bs4 import BeautifulSoup
import requests
from fake_useragent import UserAgent
from db import MYSQLither
import json
import sys, os
from random import randint

ua = UserAgent()
parse_url = "https://dostavka-byketov.ru"


def get_categories():
    main_page = requests.get(parse_url, headers={"UserAgent": ua.random})

    mainPageParse = BeautifulSoup(main_page.text, "lxml")

    catalog = mainPageParse.find("ul", class_="bx-nav-list-2-lvl")
    categories = catalog.find_all("li")
    res_categories = []
    for i in categories:
        category_name = i.text.strip()
        category_link = i.a["href"]

        res_categories.append([category_name, category_link])

    return res_categories


def main_parse(pages=11):
    categories = get_categories()

    prouctions = {}

    for category in categories:
        print(f"Парсим категорию: {category[0]}")

        for i in range(1,pages):
            print(f"Парсим {i} страницу!")
            if i == 1:
                url = f"{parse_url}{category[1]}"
            else:
                url = f"{parse_url}{category[1]}?PAGEN_1={i}"

            category_page_req = requests.get(url, headers={"UserAgent": ua.random}).text
            category_page = BeautifulSoup(category_page_req, "lxml")
            product_items = category_page.find_all("div", class_="product-item")
            for product in product_items:
                try:
                    product_title = product.find(class_="product-item-title")
                    product_link = product_title.a["href"]

                    product_page = requests.get(f"{parse_url}{product_link}", headers={"UserAgent": ua.random}).text
                    prod_parse = BeautifulSoup(product_page, "lxml")
                    product_title = prod_parse.find(id="pagetitle").text
                    print(f"Парсим {product_title}")
                    product_price = prod_parse.find(class_="product-item-detail-price-current").text.replace(" ", "").replace("руб.", "").replace(" ", "")
                    product_description = prod_parse.find(class_="product-item-detail-tab-content").contents
                    for content_item in product_description:
                        if content_item.text != "<div>\n</div>" and content_item.text != "\n":
                            product_description = content_item.text.strip()
                            break
                    preview_image = prod_parse.find(class_="product-item-detail-slider-controls-block").contents[3].img["src"]
                    preview_image = f"{parse_url}{preview_image}"

                    if category[0] not in prouctions:
                        prouctions[category[0]] = [{
                            "name": product_title,
                            "price": product_price,
                            "description": product_description,
                            "preview": preview_image
                        }]
                    else:
                        prouctions[category[0]].append(
                            {
                                "name": product_title,
                                "price": product_price,
                                "description": product_description,
                                "preview": preview_image
                            }
                        )
                except Exception as err:
                    print(err)

    with open("result.json", "w", encoding="utf-8") as f:
        json.dump(prouctions, f, indent=4, ensure_ascii=False)


args = sys.argv

db = MYSQLither()
if args[1] == "parse":
    try:
        main_parse(int(args[2]))
    except:
        main_parse()
elif args[1] == "load":
    if os.path.exists("result.json"):
        with open("result.json") as f:
            cats = json.load(f)

        for key in cats.keys():
            if not db.exists_category(key):
                category = db.add_category(key)
                print(f"Добавлена категория: {key}. id={category}")
            else:
                category = db.get_category_by_name(key)[0]
            for product in cats[key]:
                product_name = product["name"]
                product_price = product["price"]
                product_description = product["description"]
                product_preview = product["preview"]
                product_count = randint(1, 50)

                if not db.exists_product(product_name, category, product_description, product_preview):
                    db.add_product(product_name, product_price, category, product_preview, product_description,
                                   product_count)
                    print(f"Добавлен товар: {product_name}")

    else:
        print("Сначала нужно спарсить!")
elif args[1] == "create_tables":
    print("Создаём таблицы!")
    db.create_tables()

