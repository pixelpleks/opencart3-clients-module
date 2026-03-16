# OpenCart 3 Clients Module

Модуль управления клиентами/партнёрами для OpenCart 3 с поддержкой шаблона Unishop2.

## Функционал

✅ Добавление клиентов с полями:
- Название клиента
- Логотип (URL)
- Ссылка на сайт
- Описание

✅ Управление клиентами в админпанели
✅ Отдельная страница со списком клиентов
✅ Рандомный порядок отображения
✅ Сортировка и фильтрация в админе

## Установка

1. Скачайте модуль
2. Загрузите файлы в корень вашего OpenCart 3
3. Выполните SQL запрос из файла `install.sql`
4. Перейдите в админпанель → Расширения → Модули → Клиенты

## Использование

**Админпанель:** `admin/index.php?route=extension/module/clients`

**Страница клиентов:** `index.php?route=information/clients`

## Файловая структура

```
├── admin/
│   ├── controller/extension/module/clients.php
│   ├── language/ru-ru/extension/module/clients.php
│   └── view/template/extension/module/
│       ├── clients.twig
│       └── clients_form.twig
├── catalog/
│   ├── controller/extension/module/clients.php
│   ├── controller/information/clients.php
│   ├── language/ru-ru/information/clients.php
│   ├── model/extension/module/clients.php
│   └── view/theme/unishop2/template/
│       ├── extension/module/clients.twig
│       └── information/clients.twig
└── install.sql
```

## Автор

pixelpleks

## Лицензия

MIT