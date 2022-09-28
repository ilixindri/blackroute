from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys
import os
import random
def login_screen(a9, wait):
    element = WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, "email")))
    element.send_keys("alexandrogonsan@outlook.com")
    element.send_keys(Keys.RETURN)
    element = WebDriverWait(a9, wait).until(EC.presence_of_element_located((By.ID, "password")))
    element.send_keys("123")
    element.send_keys(Keys.RETURN)
def get_files_paths(folder):
    """
    return a list of completes paths of files of a folder with subfolders
    """
    files_paths = []
    for root, dirs, files in os.walk(folder):
        for file in files:
            files_paths.append(os.path.join(root, file))
        for dir in dirs:
            files_paths += get_files_paths(dir)
    return files_paths
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
def name_generator():
    first_names = ['John', 'Jane', 'Corey', 'Travis', 'Dave', 'Kurt', 'Neil', 'Sam', 'Steve', 'Tom', 'James', 'Robert', 'Michael', 'Charles', 'Joe', 'Mary', 'Maggie', 'Nicole', 'Patricia', 'Linda', 'Barbara', 'Elizabeth', 'Laura', 'Jennifer', 'Maria']
    last_names = ['Smith', 'Doe', 'Jenkins', 'Robinson', 'Davis', 'Stuart', 'Jefferson', 'Jacobs', 'Wright', 'Patterson', 'Wilks', 'Arnold', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor', 'Anderson', 'Thomas', 'Jackson', 'White', 'Harris', 'Martin']
    first_name = random.choice(first_names)
    last_name = random.choice(last_names)
    return first_name + ' ' + last_name
def create_mac():
    mac = [ 0x00, 0x16, 0x3e,
        random.randint(0x00, 0x7f),
        random.randint(0x00, 0xff),
        random.randint(0x00, 0xff) ]
    return ':'.join(map(lambda x: "%02x" % x, mac))
def create_ip():
    """
    create ip adresses
    """
    ip_list = []
    for i in range(0, 10):
        ip_list.append(str(random.randint(0, 255)) + "." + str(random.randint(0, 255)) + "." + str(random.randint(0, 255)) + "." + str(random.randint(0, 255)))
    return random.choice(ip_list)
def random_jewelry():
    jewelry = ['diamante', 'esmeralda', 'rubi', 'safira', 'topázio', 'opala', 'pérola', 'ametista', 'água-marinha', 'citrino', 'granada', 'jade', 'ônix ', 'peridoto', 'turquesa', 'zircão']
    return random.choice(jewelry)
def e(f, i):
    try:
        return f()
    except:
        input(f'Error on {i}...')
def contract(): return 'Contrato ' + str(random.randint(1,100))
def olt(): return 'Olt ' + str(random.randint(1,100))
def olt_ports(): return random.randint(1, 32)