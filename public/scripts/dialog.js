class Dialog {
    /**
     * Create a new dialog box
     * @param args A JSON object describing the dialog box.
     * Must contain: title (what will be used as title), content (html or plaintext that will be in dialog box), and
     * buttons (an array of JSON objects, each with text and onclick), optionally, and ID can be specified*/
    constructor(args) {
        let self = this;
        self.title = args.title;
        if(args.id !== undefined){
            self.id = args.id;
        } else {
            self.id = "dialog_" + args.title.replace(/ /g, "-");
        }
        self.content = args.content;
        self.buttons = args.buttons;
        self.visible = false;
        $(document).ready(function () {
            self.create(self);
        });
        $(window).resize(function () {
            self.center(self);
        });
    }

    /**
     * Create the HTML element, automatically called on document load
     * @param self reference to the dialog object*/
    create(self) {
        let buttons = "";
        for (let button of self.buttons) {
            if(button.extra===undefined)
                button.extra = "";
            buttons += `<button onclick="${button.onclick}" ${button.extra}>${button.text}</button>`;
        }
        let content = `
        <div class="dialogContainer" id="${self.id}">
        <div class="dialog">
            <div class="dialogTitle">
                <h1>${self.title}</h1>
            </div>
            <div class="dialogContent">
                ${self.content}
           </div>
            <div class="dialogButtons">
                ${buttons}
            </div>
        </div>
        </div>`;
        console.log("Creating");
        console.log(content);
        $("body").append(content);
        self.element = $("#" + self.id);
        self.center(self);
    }

    /**
     * Rebuild the HTML element, with new values*/
    rebuild(self) {
        self.element.remove();
        console.log(self.content);
        self.create(self);
    }

    /**
     * Ensure that the dialog is centered, called automatically when showing and on window resize
     * @param self reference to the dialog object*/
    center(self) {
        let element = $("#" + self.id + " .dialog");
        element[0].style.marginLeft = window.outerWidth / 2 - element.outerWidth() / 2 + "px";
    }

    /**
     * Make the dialog box visible and clickable*/
    show() {
        let self = this;
        self.element[0].style.pointerEvents = 'auto';
        self.element[0].style.display = 'block';
        self.visible = true;
        self.center(self);
        self.element[0].style.opacity = "1";
    }

    /**
     * Make the dialog box invisible and unclickable*/
    hide() {
        let self = this;
        self.visible = false;
        self.element[0].style.pointerEvents = 'none';
        self.element[0].style.opacity = "0";
        setTimeout(function () {
            self.element[0].style.display = 'none';
            self.element[0].style.pointerEvents = 'auto';
        }, 500);
    }

    /**
     * Switch between visible and invisible states*/
    toggle() {
        let self = this;
        if (self.visible) {
            self.hide();
        } else {
            self.show();
        }
    }
}