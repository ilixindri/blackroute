import sys
from lib import *
from selenium import webdriver
from selenium.webdriver.edge.service import Service
from webdriver_manager.microsoft import EdgeChromiumDriverManager
class Test(Lib):
    def __init__(self, *args, **kwargs):
        super(Test, self).__init__(*args, **kwargs)
        self.user_folder = os.path.expanduser('~')
        self.url = "http://www.luxcorporationrr.com.br:8282/"
        self.wait = 10
        self.folder = f"{self.user_folder}/Repos/blackroute/app/Models/"
        if not os.path.exists(self.folder):
            self.folder = f"{self.user_folder}/Nextcloud/Repos/blackroute/app/Models/"
        self.files = self.get_files_paths(self.folder)
        self.menus = []
        if len(self.files) == 0: print('No self.files with settings'); print(f"self.folder verified: {self.folder}"); exit()
        for self.file in self.files:
            with open(self.file) as self.f:
                for line in self.f:
                    if line.find('menu') != -1:
                        self.menus += [self.file[:-4].split('/')[-1].lower()+'s']
                        break
        if len(self.menus) == 0: print('No menu in settings'); exit()
        self.options = webdriver.EdgeOptions()
        with webdriver.Edge(service=Service(EdgeChromiumDriverManager().install()), options=self.options) as self.browser:
            self.browser.set_window_size(1920, 1080)
            self.browser.get(self.url)
            self.login_screen()
            if self.browser.current_url.split('/')[-1] != "dashboard":
                input("Check dashboard with error.")
            for self.i in range(len(self.menus)):
                self.menus_function()
            input("Fim...")
def main(): Test()
if __name__ == '__main__' :
    print(f"Run the script: {sys.argv[0]}")
    main()
