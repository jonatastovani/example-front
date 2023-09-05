class EnumAction {
    static get GET() {
        return 'GET';
    }

    static get POST() {
        return 'POST';
    }

    static get PUT() {
        return 'PUT';
    }

    static get DELETE() {
        return 'DELETE';
    }

    static isValid(value) {
        return Object.values(EnumAction).includes(value);
    }
}

export { EnumAction };
