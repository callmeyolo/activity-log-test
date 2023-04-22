Vue.component('activity-log', {
  props: ['logs'],
  template: `
    <table class="table">
      <thead>
        <tr>
          <th>User</th>
          <th>Action</th>
          <th>Details</th>
          <th>Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="log in logs">
          <td>{{ log.user_name }}</td>
          <td>{{ log.activity_type }}</td>
          <td>{{ log.description }}</td>
          <td>{{ new Date(log.timestamp).toLocaleString() }}</td>
        </tr>
      </tbody>
    </table>
  `
});

const app = new Vue({
  el: '#app',
  data: {
      activityLogs: [],
      newActivity: {
        user_name: '',
        activity_type: '',
        description: ''
      }
    },
  mounted() {
    this.fetchActivityLogs();
  },
  methods: {
    fetchActivityLogs() {
      fetch('get_activity_logs.php')
        .then(response => response.json())
        .then(data => {
          this.activityLogs = data;
        })
        .catch(error => {
          console.log('Error fetching activity logs:');
          console.log(error)
        });
    },
    addActivity() {
      const formData = new FormData();
      formData.append('user', this.newActivity.user_name);
      formData.append('action', this.newActivity.activity_type);
      formData.append('details', this.newActivity.description);

      fetch('add_activity_log.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            this.activityLogs.unshift(data.activity);
            this.newActivity = { user_name: '', activity_type: '', description: '' };
          } else {
            console.log('Error adding activity:', data.error);
          }
        })
        .catch(error => {
          console.log('Error adding activity:', error);
        });
    }
  }
});
