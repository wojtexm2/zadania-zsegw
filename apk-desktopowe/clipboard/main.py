import sys, os, subprocess, platform
from PyQt5.QtWidgets import (
    QApplication, QMainWindow, QWidget, QFileDialog,
    QVBoxLayout, QHBoxLayout,
    QPushButton, QListView,
    QMessageBox
)
from PyQt5.QtGui import QStandardItemModel, QStandardItem, QPixmap, QIcon
from PyQt5.QtCore import QSize, QMimeData, QUrl
import pyperclip

class DnDList(QListView):
    def __init__(self, parent=None):
        super().__init__(parent)
        self.setAcceptDrops(True)

    def dragEnterEvent(self, event):
        if event.mimeData().hasUrls():
            event.accept()
        else:
            event.ignore()

    def dragMoveEvent(self, event):
        if event.mimeData().hasUrls():
            event.accept()
        else:
            event.ignore()

    def dropEvent(self, event):
        if event.mimeData().hasUrls():
            for url in event.mimeData().urls():
                file_path = url.toLocalFile()

                item = QStandardItem(file_path)
                item.setEditable(False)
                item.setIcon(QIcon(QPixmap(file_path)))
                self.model().appendRow(item)
        else:
            event.ignore()
class Main(QMainWindow):
    def __init__(self):
        super().__init__()
        self.setWindowTitle("Clipboard")
        self.savepath: str = None


        layout_up = QHBoxLayout()
        view_catalogue_button = QPushButton("Przeglądaj katalog")
        view_catalogue_button.pressed.connect(self.on_view_catalogue_button_pressed)
        layout_up.addWidget(view_catalogue_button)

        save_txt = QPushButton("Zapisz TXT")
        save_txt.pressed.connect(self.on_save_txt_pressed)
        layout_up.addWidget(save_txt)

        layout_middle = QHBoxLayout()

        self.listview = DnDList(self)
        self.listview.setIconSize(QSize(60, 60))
        self.listmodel = QStandardItemModel()
        self.listview.setModel(self.listmodel)

        layout_middle.addWidget(self.listview)

        layout_down = QHBoxLayout()
        copy_button = QPushButton("Kopiuj")
        copy_button.pressed.connect(self.on_copy_button_pressed)
        layout_down.addWidget(copy_button)

        open_catalogue_button = QPushButton("Otwórz katalog")
        open_catalogue_button.pressed.connect(self.on_open_catalogue_button)
        layout_down.addWidget(open_catalogue_button)

        delete_item_button = QPushButton("Usuń z listy")
        delete_item_button.pressed.connect(self.delete_button_pressed)
        layout_down.addWidget(delete_item_button)

        layout_main = QVBoxLayout()
        layout_main.addLayout(layout_up)
        layout_main.addLayout(layout_middle)
        layout_main.addLayout(layout_down)

        widget = QWidget()
        widget.setLayout(layout_main)


        self.setCentralWidget(widget)
        self.show()
    
    def delete_button_pressed(self):
        for index in self.listview.selectedIndexes():
            self.listmodel.removeRow(index.row())

    def on_save_txt_pressed(self):
        if not self.savepath:
            msgbox = QMessageBox()
            msgbox.setText("Nie wybrano ścieżki zapisu. Wybierz ścieżkę klikając przycisk \"Przeglądaj katalog\"")
            msgbox.setIcon(QMessageBox.Warning)
            msgbox.setStandardButtons(QMessageBox.Ok)
            msgbox.setWindowTitle("Zapis")
            msgbox.show()

            msgbox.exec_()
            return
        
        with open(self.savepath+"\\lista.txt", "w") as file:
            for row in range(self.listmodel.rowCount()):
                item = self.listmodel.item(row)
                file.write(item.text()+'\n')

    def on_copy_button_pressed(self):
        #Powtarzający się kod, ale to nie jest aplikacja którą będziemy rozbudowywać
        indexes = self.listview.selectedIndexes()
        if not indexes:
            return
        
        path = self.listmodel.itemFromIndex(indexes[0]).text()

        mimedata = QMimeData()
        fileurl = QUrl.fromLocalFile(path)
        mimedata.setUrls([fileurl])

        QApplication.clipboard().setMimeData(mimedata)

    def on_view_catalogue_button_pressed(self):
        self.savepath = QFileDialog.getExistingDirectory(self, 'Select Folder')

    def on_open_catalogue_button(self):
        indexes = self.listview.selectedIndexes()
        if not indexes:
            return
        
        path = self.listmodel.itemFromIndex(indexes[0]).text()

       #Dla ciekawych, Windows nie lubi pythonowych ścieżek. 
        folderpath = os.path.dirname(path).replace('/', '\\')

        #Pisząc to nie pomyślałem że PyQt5 może obsługiwać takie rzeczy natywnie, ale już nie będę niczego zmieniał, bo przynajmniej jest oryginalnie.
        match platform.system():
            case "Linux":
                subprocess.run(["xdg-open", folderpath])
            case "Windows":
                subprocess.run(["explorer", folderpath])

app = QApplication(sys.argv)
window = Main()

app.exec()