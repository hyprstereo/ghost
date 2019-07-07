<template>
  <div>
    <div class="table-operations" v-if="showOptions">
      <a-button @click="setAgeSort">Sort age</a-button>
      <a-button @click="clearFilters">Clear filters</a-button>
      <a-button @click="clearAll">Clear filters and sorters</a-button>
    </div>
    <div>
        <h3>
        <a-icon type="solution" /> Rekod Kes
        </h3>
    </div>
    <a-divider/>
    <a-table :columns="columns" :dataSource="cases" @change="handleChange" >
      <template slot="operation" slot-scope="text, record">
        <a-popconfirm
          title="Sure to delete?"
          @confirm="()=>onDelete(record.key)"
        >
        <a href="javascript:;">Delete</a>
        </a-popconfirm>
        <a-divider type="vertical" />
        <a href="javascript:;" @click="onEdit(record.key)">Edit</a>

      </template>
    </a-table>
  </div>
</template>
<script>
import axios from 'axios';
const data = [
    {
        key: '1',
        serial: 'xxxx-xx-xxxx',
        case: 'case title 1',
        status: 'Open',
        date: '5/05/2019'
    },
    {
        key: '2',
        serial: 'xxxx-xx-xxxx',
        case: 'case title 2',
        status: 'Closed',
        date: '08/05/2019'
    },
    {
        key: '3',
        serial: 'xxxx-xx-xxxx',
        case: 'case title 3',
        status: 'New',
        date: '11/05/2019'
    }
];

export default {
  data() {
    return {
      cases: null,
      data,
      showOptions: false,
      filteredInfo: null,
      sortedInfo: null,
      casesData: null,
    }
  },
  computed: {
    columns() {
      let { sortedInfo, filteredInfo } = this;
      sortedInfo = sortedInfo || {};
      filteredInfo = filteredInfo || {};
      const columns = [{
        title: 'No. Kes',
        dataIndex: 'serial',
        key: 'serial',
      }, {
        title: 'Stesen/Lokasi',
        dataIndex: 'location',
        key: 'location',
      }, {
        title: 'Status',
        dataIndex: 'status',
        key: 'status',
        filters: [
          { text: 'New', value: 'New' },
          { text: 'Open', value: 'Open' },
          { text: 'Closed', value: 'Closed' },
        ]
      },
      {
          title: 'Date',
          dataIndex: 'date',
          key: 'date',
      },
    {
      title: 'Operasi',
      dataIndex: 'operation',
      scopedSlots: {customRender: 'operation'}
    }

      ];
      return columns;
    }
  },
  mounted() {
    this.getCases();
  },
  methods: {
    getCases() {
      let self = this;
      axios
        .get('/api/records')
        .then(result=>{
          console.log(result);
          let data = result.data;
          this.casesData = data;
          let res = [];
          for (let i = 0; i < data.length; i++) {
            let _case = data[i];
            let _status = (data[i].status == 1) ? 'Closed' : 'Open';
            let _location = data[i].station + '/' + data[i].location;
            res.push({
              'key': i.toString(),
              'serial': _case.case_no,
              'location': _location,
              'status': _status,
              'date': data[i].date
            })
          }
          self.cases = res;
        })
        .catch(err=> {
          console.log('err> ' + err);
        })

    },
    handleChange (pagination, filters, sorter) {
      console.log('Various parameters', pagination, filters, sorter);
      this.filteredInfo = filters;
      this.sortedInfo = sorter;
    },
    clearFilters () {
      this.filteredInfo = null;
    },
    clearAll () {
      this.filteredInfo = null;
      this.sortedInfo = null;
    },
    onDelete (key) {
      console.log('delete ' + key);
    },
    onEdit (key) {
      console.log('edit ' + key);
      let editProfile = this.casesData[key];
      console.log(editProfile);
      this.$router.push('case/' + editProfile.id.toString());
    }
  }
}
</script>
<style scoped>
.table-operations {
  margin-bottom: 16px;
  font-size: 12px;
}

.table-operations > button {
  margin-right: 8px;
}
</style>