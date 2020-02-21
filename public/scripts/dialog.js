class Dialog {

    constructor(args) {
        let self = this;
        self.title = args.title;
        self.id = "dialog_" + args.title.replace(/ /g, "-");
        self.content = args.content;
        self.buttons = args.buttons;
        self.visible = false;
        $(document).ready(function () {
            self.create(self);
        });
        $(window).resize(function (){
            self.center(self);
        });
    }

    create(self) {
        let content = `
        <div class="dialog" id="${self.id}">
            <div class="dialogTitle">
                <h1>${self.title}</h1>
            </div>
                <div class="dialogContent">
                ${self.content}
               </div>
            <div class="dialogButtons">
                <button>Click me!</button>
            </div>
            </div>`;
        console.log("Creating");
        console.log(content);
        $("body").append(content);
        self.element = $("#" + self.id);
        self.center(self);
    }

    center(self){
        self.element[0].style.left = -self.element.outerWidth() / 2+"px";
    }

    show() {
        let self = this;

    }

    hide() {
        let self = this;

    }

    toggle() {
        let self = this;

    }
}