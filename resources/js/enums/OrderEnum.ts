export function stateLabel(state: number): string {
    switch (state) {
        case 0:
            return "Pending";
        case 1:
            return "Validated";
        case 2:
            return "Canceled";
        case 3:
            return "Rejected";
        default:
            return "Unknown";
    }
}

export function stateColor(state: number): string {
    switch (state) {
        case 0:
            return 'bg-warning text-white';
        case 1:
            return 'bg-success text-white';
        case 2:
            return 'bg-danger text-white';
        default:
            return 'bg-secondary text-white';
    }
}

