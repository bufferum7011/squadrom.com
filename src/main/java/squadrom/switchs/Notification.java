package squadrom.switchs;

public enum Notification {

    NONE            ("Нет сообщений", false),
    ERROR_404       ("Ошибка", true),
    ALERT_LOGIN     ("Логин изменен", true),
    ALERT_EMAIL     ("Почта изменена", true),
    ALERT_PASSWORD  ("Пароль изменен", true),
    REGISTRY        ("Вы зарегистрировались на Squadrom.com", true),
    LOGIN           ("Вы вошли Squadrom.com", true);

    private String msg;
    private boolean key;
    
    Notification(String msg) {
        this.msg = msg;
    }
    Notification(String msg, boolean key) {
        this.msg = msg;
        this.key = key;
    }

    public String get_msg() { return msg; }
    public boolean get_key() { return key; }

}