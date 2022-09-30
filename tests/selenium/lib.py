import argparse
import traceback
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys
import os
import random


class Lib(argparse.Namespace):
    def __init__(self):
        super(Lib, self).__init__()

    def login_screen(self):
        self.element = WebDriverWait(self.browser, self.wait).until(EC.presence_of_element_located((By.ID, "email")))
        self.element.send_keys("alexandrogonsan@outlook.com")
        self.element.send_keys(Keys.RETURN)
        self.element = WebDriverWait(self.browser, self.wait).until(EC.presence_of_element_located((By.ID, "password")))
        self.element.send_keys("123")
        self.element.send_keys(Keys.RETURN)

    @staticmethod
    def get_files_paths(folder):
        """
        return a list of completes paths of files of a folder with subfolders
        """
        files_paths = []
        for root, dirs, files in os.walk(folder):
            for file in files:
                files_paths.append(os.path.join(root, file))
            for folder in dirs:
                files_paths += get_files_paths(folder)
        return files_paths

    @staticmethod
    def generate_birth_date():
        year = random.randint(1930, 2000)
        month = random.randint(1, 12)
        day = random.randint(1, 28)
        if month < 10:
            month = "0" + str(month)
        else:
            month = str(month)
        if day < 10:
            day = "0" + str(day)
        else:
            day = str(day)
        return str(year) + "-" + month + "-" + day

    @staticmethod
    def name_generator():
        first_names = ['John', 'Jane', 'Corey', 'Travis', 'Dave', 'Kurt', 'Neil', 'Sam', 'Steve', 'Tom', 'James',
                       'Robert', 'Michael', 'Charles', 'Joe', 'Mary', 'Maggie', 'Nicole', 'Patricia', 'Linda',
                       'Barbara', 'Elizabeth', 'Laura', 'Jennifer', 'Maria']
        last_names = ['Smith', 'Doe', 'Jenkins', 'Robinson', 'Davis', 'Stuart', 'Jefferson', 'Jacobs', 'Wright',
                      'Patterson', 'Wilks', 'Arnold', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller',
                      'Wilson', 'Moore', 'Taylor', 'Anderson', 'Thomas', 'Jackson', 'White', 'Harris', 'Martin']
        first_name = random.choice(first_names)
        last_name = random.choice(last_names)
        return first_name + ' ' + last_name

    @staticmethod
    def create_mac():
        import random
        mac = [0x00, 0x16, 0x3e, random.randint(0x00, 0x7f), random.randint(0x00, 0xff), random.randint(0x00, 0xff)]
        return ':'.join(map(lambda x: "%02x" % x, mac))

    @staticmethod
    def create_ip():
        """
        create ip adresses
        """
        ip_list = []
        for i in range(0, 10):
            ip_list.append(str(random.randint(0, 255)) + "." + str(random.randint(0, 255)) + "." +
                           str(random.randint(0, 255)) + "." + str(random.randint(0, 255)))
        return random.choice(ip_list)

    @staticmethod
    def random_jewelry():
        jewelry = ['diamante', 'esmeralda', 'rubi', 'safira', 'topázio', 'opala', 'pérola', 'ametista', 'água-marinha',
                   'citrino', 'granada', 'jade', 'ônix ', 'peridoto', 'turquesa', 'zircão']
        return random.choice(jewelry)

    @staticmethod
    def e(f, i, line_file):
        try:
            return f()
        except Exception as e:
            traceback.print_exc()
            line = line_file[0]
            file = line_file[1]
            input(f'Error on {i}...')

    @staticmethod
    def contract(): return 'Contrato ' + str(random.randint(1, 100))

    @staticmethod
    def line(uuid, file):
        with open(file) as f: c = f.read()
        for line in c.split('\n'):
            if line.find(uuid) != -1:
                line = c.split('\n').index(line)
                return line, os.path.basename(file)

    @staticmethod
    def olt(): return 'Olt ' + str(random.randint(1, 100))

    @staticmethod
    def olt_ports(): return random.randint(1, 32)

    def menus_function(self):
        from selenium.webdriver.common.by import By
        from selenium.webdriver.support.wait import WebDriverWait
        from selenium.webdriver.support import expected_conditions as ec
        from selenium.webdriver.common.action_chains import ActionChains
        from selenium.webdriver.support.select import Select
        import requests
        import time
        import datetime
        import random
        self.browser.get(self.url)
        self.element = self.e(lambda: WebDriverWait(self.browser, self.wait)
                              .until(EC.presence_of_element_located((By.ID, self.menus[self.i]))), self.menus[self.i],
                              self.line('22cab17340ae11ed924a6432a87ef3c0', __file__))
        ActionChains(self.browser).move_to_element(self.element).perform()
        self.element = self.e(lambda: WebDriverWait(self.browser, self.wait)
                              .until(EC.presence_of_element_located(
                                 (By.ID, self.menus[self.i] + "-create"))), self.menus[self.i] + "-create",
                                    self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
        self.element.click()
        if self.browser.current_url != self.url + self.menus[self.i] + "/create":
            input("Check click to page wrong.")
        self.aux = self.url + "api/tests/" + self.menus[self.i] + "/forms"
        response = requests.get(self.aux)
        try:
            self.form = response.json()
        except Exception as e:
            print(response.text[:20000])
            traceback.print_exc()
            path = 'pages/' + datetime.now().strftime("%Y%m%dT%H:%M:%S-4") + "/" + self.aux.replace('/', '_')
            with open(path, 'w') as f: f.write(response.text)
            file = f"{self.user_folder}/Repos/blackroute/tests/selenium/{path}"
            if not os.path.isfile(file):
                file = f"{self.user_folder}/Nextcloud/Repos/blackroute/tests/selenium/{path}"
            url = f'file://{file}'
            self.browser.get(url)
            input("Continuar?")
        self.aux = self.url + "api/tests/" + self.menus[self.i] + "/tests"
        response = requests.get(self.aux)
        try:
            self.tests = response.json()
        except Exception as e:
            print(response.text[:20000])
            traceback.print_exc()
            print(self.menus[self.i])
            input('Error...')
            self.tests = []
        for self.test in self.tests:
            self.key = -1
            for self.section in self.test:
                self.key += 1
                self.element = self.e(lambda: WebDriverWait(self.browser, self.wait)
                                      .until(EC.presence_of_element_located(
                                        (By.ID, "title" + str(self.key)))), "title" + str(self.key),
                                            self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                if self.element is False: return self.menus_function(self.i)
                self.element.screenshot('c:/s.png')
                self.element.click()
                self.model = self.form[1:][self.key]['model'].split('\\')[-1].lower()
                if self.model[-1] != 's':
                    self.model += 's'
                else:
                    self.model += 'es'
                for self.field in self.section:
                    self.aux = self.url + "api/tests/" + self.model + "/" + self.field + "__datas"
                    response = requests.get(self.aux)
                    self.var = self.e(lambda: response.json(), self.aux + '\n' + response.text[:20000],
                                      self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                    if self.var is False: return self.menus_function()
                    if self.var is None: continue
                    self.value_received = self.section[self.field]
                    if not self.value_received is list:
                        try: self.value = str(eval(self.value_received))
                        except: value = str(self.value_received)
                        self.flexion = 'presence_of_element_located'
                    else: self.flexion = 'presence_of_element_located'#'presence_of_all_elements_located'
                    self.element = self.e(lambda : WebDriverWait(self.browser, self.wait).until(getattr(EC, self.flexion)((By.ID, self.field))), self.field,
                                          self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                    if self.element == False: return self.menus_function()
                    if not 'type' in self.var:
                        if self.var[0] == 'select':
                            if self.value_received is list:
                                for self.j in range(len(self.value_received)):
                                    self.value = self.value_received[self.i]
                                    self.element = Select(self.element)
                                    self.r = self.e(lambda: self.element.select_by_valuself.e(self.value),
                                          f'select_by_value of {self.field} with self.value {self.value}',
                                                self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                                    if self.r is False: return self.menus_function()
                                    if self.j != len(self.value_received):
                                        self.by_id = f'add_select{self.field}0'
                                        self.elemen = self.e(
                                            lambda: WebDriverWait(self.browser, self.wait).until(EC.presence_of_element_located((By.ID, self.by_id))),
                                            self.field,
                                            self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                                        if self.elemen is False: return self.menus_function()
                                        self.elemen.click()
                            else:
                                self.element = Select(self.element)
                                self.r = self.e(lambda : self.element.select_by_valuself.e(self.value), f'select_by_value of {self.field} with self.value {self.value}',
                                                self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                                if self.r is False: return self.self.menus_function()
                        else:
                            r = self.e(lambda : self.element.send_keys(self.value), f'send_keys of {self.field}',
                                       self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                            if r is False: return self.menus_function()
                    elif self.var['type'] == 'select':
                        if self.value_received is list:
                            for j in range(len(self.value_received)):
                                self.value = self.value_received[self.i]
                                self.element = Select(self.element)
                                r = self.e(lambda: self.element.select_by_valuself.e(self.value),
                                      f'select_by_value of {self.field} with self.value {self.value}',
                                           self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                                if r is False: return self.menus_function()
                                if j != len(self.value_received):
                                    self.by_id = f'add_select{self.field}0'
                                    self.elemen = self.e(
                                        lambda: WebDriverWait(self.browser, self.wait).until(EC.presence_of_element_located((By.ID, self.by_id))),
                                        self.field,
                                        self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                                    if self.elemen is False: return self.menus_function()
                                    self.elemen.click()
                    else:
                        r = self.e(lambda : self.element.send_keys(self.value_received), f'send_keys of {self.field}',
                                   self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                        if r is False: return self.menus_function()
                self.element = self.e(lambda : WebDriverWait(self.browser, self.wait).until(EC.presence_of_element_located((By.ID, 'submit'))), 'submit',
                                      self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                if self.element is False: return self.self.menus_function()
                r = self.e(lambda: self.element.click(), 'click in submit',
                           self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                if r is False: return self.menus_function()
                time.sleep(1)
                if self.browser.current_url.split('/')[-1] != "edit":
                    input("Check send form with error or with error in self.url.")
                for self.field in self.section:
                    self.aux = self.url + "api/tests/" + self.model + "/" + self.field + "__datas"
                    response = requests.get(self.aux)
                    self.var = self.e(lambda: response.json(), self.aux,
                                      self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                    if self.var is False: return self.menus_function()
                    if self.var is None:
                        continue
                    self.value_received = self.section[self.field]
                    if not self.value_received is list:
                        try: self.value = str(eval(self.value_received))
                        except: self.value = str(self.value_received)
                        self.flexion = 'presence_of_element_located'
                    else: self.flexion = 'presence_of_element_located'#'presence_of_all_elements_located'
                    self.element = self.e(lambda : WebDriverWait(self.browser, self.wait).until(getattr(ec, self.flexion)((By.ID, self.field))), self.field,
                                          self.line('d93d061440af11eda7cf6432a87ef3c0', __file__))
                    if self.element is False: return self.menus_function()
                    if not 'type' in self.self.var:
                        if self.self.var[0] == 'select':
                            if self.value_received is list:
                                for i in range(len(self.value_received)):
                                    self.value = self.value_received[self.i]
                                    self.element = Select(self.element)
                                    self.page_value = self.element.first_selected_option.get_attributself.e('self.value')
                                    if self.page_value != self.value:
                                        input(f'Error in assert self.value {self.value} in select with id {self.field}; self.value of page is {self.page_value}')
                            self.element = Select(self.element)
                            self.page_value = self.element.first_selected_option.get_attributself.e('self.value')
                            if self.page_value != self.value:
                                input(f'Error in assert self.value {self.value} in select with id {self.field}; self.value of page is {self.page_value}')
                        else:
                            self.page_value = self.element.text
                            if self.page_value != self.value:
                                input(f'Error in assert self.value {self.value} in self.element with id {self.field}; self.value of page is {self.page_value}')
                    elif self.var['type'] == 'select':
                        if self.value_received is list:
                            for self.i in range(len(self.value_received)):
                                self.value = self.value_received[self.i]
                                self.element = Select(self.element)
                                self.page_value = self.element.first_selected_option.get_attributself.e('self.value')
                                if self.page_value != self.value:
                                    input(f'Error in assert self.value {self.value} in select with id {self.field}; self.value of page is {self.page_value}')
                    else:
                        self.page_value = self.element.text
                        if self.page_value != self.value:
                            input(
                                f'Error in assert self.value {self.value} in self.element with id {self.field}; self.value of page is {self.page_value}')
if __name__ == '__main__':
    print(__file__)
