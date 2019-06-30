const LOCATIONS_DATA = [
    {
        location: 'Sabah',
        children: [
            {
                location: 'Kota Kinabalu',
            },
            {
                location: 'Sandakan',
            },
            {
                location: 'Tawau',
            },
            {
                location: 'Keningau',
            }
        ]
    }
];

class LocationGenerator {
    constructor() {
        this.locations = [];
    }

    generate () {
        this.locations = this.getLocations (LOCATIONS_DATA);
        return this.locations;
    }

    getLocations (loc) {
        let result = [];
        loc.forEach ((item, index) => {
            console.log(item.location);
            let newItem = {
                value: item.location,
                label: item.location
            };

            if (item.children) {
                newItem.children = this.getLocations(item.children);
            }
            result.push (newItem);
        });
        return result;
    }
}

export default LocationGenerator;