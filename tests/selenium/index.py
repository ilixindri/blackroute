import traceback
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.edge.service import Service
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.keys import Keys
from tqdm import trange
from webdriver_manager.microsoft import EdgeChromiumDriverManager
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support.select import Select
import requests
import time
import random
from lib import *
url = "http://www.luxcorporationrr.com.br:8282/"
wait = 10
folder = "C:/Users/Alexandro/Repos/blackroute/app/Models/"
files = get_files_paths(folder)
datas = []
menus = []
for file in files:
    with open(file) as f:
        for line in f:
            if line.find('menu') != -1:
                menus += [file[:-4].split('/')[-1].lower()+'s']
                break
options = webdriver.EdgeOptions()
with webdriver.Edge(service=Service(EdgeChromiumDriverManager().install()), options=options) as a9:
    a9.get(url)
    login_screen(a9, wait)
    if a9.current_url.split('/')[-1] != "dashboard":
        input("Check dashboard with error.")
    def m(i, menus):
        a9.get(url)
        element = e(lambda : WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, menus[i]))), menus[i])
        ActionChains(a9).move_to_element(element).perform()
        element = e(lambda : WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, menus[i] + "-create"))), menus[i] + "-create")
        element.click()
        if a9.current_url != url + menus[i] + "/create":
            input("Check click to page wrong.")
        aux = url + "api/tests/" + menus[i] + "/forms"
        response = requests.get(aux)
        form = response.json()
        aux = url + "api/tests/" + menus[i] + "/tests"
        response = requests.get(aux)
        try:
            tests = response.json()
        except:
            traceback.print_exc()
            print(menus[i])
        for test in tests:
            key = -1
            for section in test:
                key += 1
                element = e(lambda : WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, "title" + str(key)))), "title" + str(key))
                if element == False: return m(i, menus)
                element.click()
                model = form[1:][key]['model'].split('\\')[-1].lower()
                if model[-1] != 's':
                    model += 's'
                else:
                    model += 'es'
                for field in section:
                    aux = url + "api/tests/" + model + "/" + field + "__datas"
                    response = requests.get(aux)
                    var = e(lambda : response.json(), aux)
                    if var == False: return m(i, menus)
                    if var is None:
                        continue
                    value_received = section[field]
                    if not value_received is list:
                        try: value = str(eval(value_received))
                        except: value = str(value_received)
                        flexion = 'presence_of_element_located'
                    else: flexion = 'presence_of_element_located'#'presence_of_all_elements_located'
                    element = e(lambda : WebDriverWait(a9, wait).until(getattr(EC, flexion)((By.ID, field))), field)
                    if element == False: return m(i, menus)
                    if not 'type' in var:
                        if var[0] == 'select':
                            if value_received is list:
                                for i in range(len(value_received)):
                                    value = value_received[i]
                                    element = Select(element)
                                    r = e(lambda: element.select_by_value(value),
                                        f'select_by_value of {field} with value {value}')
                                    if r == False: return m(i, menus)
                                    if i != len(value_received):
                                        elemen = e(
                                            lambda: WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, field))),
                                            field)

                            else:
                                element = Select(element)
                                r = e(lambda : element.select_by_value(value), f'select_by_value of {field} with value {value}')
                                if r == False: return m(i, menus)
                        else:
                            r = e(lambda : element.send_keys(value), f'send_keys of {field}')
                            if r == False: return m(i, menus)
                    elif var['type'] == 'select':
                        element = Select(element)
                        r = e(lambda : element.select_by_value(value), f'select_by_value of {field} with value {value}')
                        if r == False: return m(i, menus)
                    else:
                        r = e(lambda : element.send_keys(value), f'send_keys of {field}')
                        if r == False: return m(i, menus)
                element = e(lambda : WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, 'submit'))), 'submit')
                if element == False: return m(i, menus)
                r = e(lambda : element.click(), 'click in submit')
                if r == False: return m(i, menus)
                time.sleep(1)
                if a9.current_url.split('/')[-1] != "edit":
                    input("Check send form with error or with error in url.")
                for field in section:
                    aux = url + "api/tests/" + model + "/" + field + "__datas"
                    response = requests.get(aux)
                    var = e(lambda: response.json(), aux)
                    if var == False: return m(i, menus)
                    if var is None:
                        continue
                    element = e(lambda: WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, field))),
                                field)
                    if element == False: return m(i, menus)
                    try:
                        value = str(eval(section[field]))
                    except:
                        value = str(section[field])
                    if not 'type' in var:
                        if var[0] == 'select':
                            element = Select(element)
                            page_value = element.first_selected_option.get_attribute('value')
                            if page_value != value:
                                  input(f'Error in assert value {value} in select with id {field}; value of page is {page_value}')
                        else:
                            page_value = element.text
                            if page_value != value:
                                  input(f'Error in assert value {value} in element with id {field}; value of page is {page_value}')
                    elif var['type'] == 'select':
                        element = Select(element)
                        page_value = element.first_selected_option.get_attribute('value')
                        if page_value != value:
                            input(
                                f'Error in assert value {value} in select with id {field}; value of page is {page_value}')
                    else:
                        page_value = element.text
                        if page_value != value:
                            input(
                                f'Error in assert value {value} in element with id {field}; value of page is {page_value}')
    for i in range(len(menus)):
        m(i, menus)
    input("Fim...")
if __name__ == '__main__' :
    pass
