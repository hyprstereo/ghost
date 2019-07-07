<template>
  <div>
    <!--<div class="table-operations" v-if="showOptions">
      <a-button @click="setAgeSort">Sort age</a-button>
      <a-button @click="clearFilters">Clear filters</a-button>
      <a-button @click="clearAll">Clear filters and sorters</a-button>
    </div>-->
    <div>
        <h3>
        <a-icon type="solution" /> Rekod Kes
        </h3>
    </div>
    <a-divider/>
    <a-table :columns="columns" :dataSource="cases" @change="handleChange" >
      <div slot="filterDropdown" slot-scope="{ setSelectedKeys, selectedKeys, confirm, clearFilters, column }" class='custom-filter-dropdown'>
      <a-input
        v-ant-ref="c => searchInput = c"
        :placeholder="`Search ${column.dataIndex}`"
        :value="selectedKeys[0]"
        @change="e => setSelectedKeys(e.target.value ? [e.target.value] : [])"
        @pressEnter="() => handleSearch(selectedKeys, confirm)"
        style="width: 188px; margin-bottom: 8px; display: block;"
      />
      <a-button
        type='primary'
        @click="() => handleSearch(selectedKeys, confirm)"
        icon="search"
        size="small"
        style="width: 90px; margin-right: 8px"
      >Search</a-button>
      <a-button
        @click="() => handleReset(clearFilters)"
        size="small"
        style="width: 90px"
      >Reset</a-button>
    </div>
    <a-icon slot="filterIcon" slot-scope="filtered" type='search' :style="{ color: filtered ? '#108ee9' : undefined }" />
    <template slot="customRender" slot-scope="text">
      <span v-if="searchText">
        <template v-for="(fragment, i) in text.toString().split(new RegExp(`(?<=${searchText})|(?=${searchText})`, 'i'))">
          <mark v-if="fragment.toLowerCase() === searchText.toLowerCase()" :key="i" class="highlight">{{fragment}}</mark>
          <template v-else>{{fragment}}</template>
        </template>
      </span>
      <template v-else>{{text}}</template>
    </template>
      <template slot="operation" slot-scope="text, record">
        <a :href="getLink(record.key)">Report</a>
        <a-divider type="vertical" />
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

export default {
  props:['__ob__'],
  data() {
    return {
      cases: [],
      searchText: '',
      searchInput: null,
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
        scopedSlots: {
          filterDropdown: 'filterDropdown',
          filterIcon: 'filterIcon',
          customRender: 'customRender'
        },
        onFilter: (value, record) => record.serial.toLowerCase().includes(value.toLowerCase()),
        onFilterDropdownVisibleChange: (visible) => {
          if (visible) {
            setTimeout(() => {
              this.searchInput.focus()
            },0)
          }
        }
      },
      {
        title: 'Orang Kena Tuduh',
        dataIndex: 'accused',
        key: 'accused',
        scopedSlots: {
          filterDropdown: 'filterDropdown',
          filterIcon: 'filterIcon',
          customRender: 'customRender'
        },
        onFilter: (value, record) => record.accused.toLowerCase().includes(value.toLowerCase()),
        onFilterDropdownVisibleChange: (visible) => {
          if (visible) {
            setTimeout(() => {
              this.searchInput.focus()
            },0)
          }
        }
      }, {
        title: 'Status',
        dataIndex: 'status',
        key: 'status',
        scopedSlots: {
          filterDropdown: 'filterDropdown',
          filterIcon: 'filterIcon',
          customRender: 'customRender'
        },
        onFilter: (value, record) => record.status.toLowerCase().includes(value.toLowerCase()),
        onFilterDropdownVisibleChange: (visible) => {
          if (visible) {
            setTimeout(() => {
              this.searchInput.focus()
            },0)
          }
        }
      },
      {
          title: 'Tarikh',
          dataIndex: 'date',
          key: 'date',
          scopedSlots: {
          filterDropdown: 'filterDropdown',
          filterIcon: 'filterIcon',
          customRender: 'customRender'
        },
        onFilter: (value, record) => record.date.toLowerCase().includes(value.toLowerCase()),
        onFilterDropdownVisibleChange: (visible) => {
          if (visible) {
            setTimeout(() => {
              this.searchInput.focus()
            },0)
          }
        }
      },
    {
      title: 'Operasi',
      dataIndex: 'operation',
      scopedSlots: {
          customRender: 'operation'
        }
    }

      ];
      return columns;
    }
  },
  created () {
    this.getCases();
  },
  methods: {
    handleSearch (selectedKeys, confirm) {
      confirm()
      this.searchText = selectedKeys[0]
    },

    handleReset (clearFilters) {
      clearFilters()
      this.searchText = ''
    },
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
            let _accused = data[i].profiles[0].name + ' (' + data[i].profiles[0].identification + ')';
            res.push({
              'key': i.toString(),
              'serial': _case.case_no,
              'accused': _accused,
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
      let editProfile = this.casesData[key];
      let self = this;
      axios
        .post('/api/case_delete', {id: editProfile.id})
        .then(result=>{
          self.getCases();
        })
        .catch(err=> {
          console.log('err> ' + err);
        })
    },
    onEdit (key) {
      console.log('edit ' + key);
      let editProfile = this.casesData[key];
      console.log(editProfile);
      this.$router.push('case/' + editProfile.id.toString());
    },
    onDownload (key) {
      let editProfile = this.casesData[key];
      let url = '/api/report?id=' + editProfile.id.toString();
    },
    getLink (key) {
      let editProfile = this.casesData[key];
      let url = '/api/report?id=' + editProfile.id.toString();
      return url;
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